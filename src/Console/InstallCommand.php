<?php

namespace Agenciafmd\Admix\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;
use RuntimeException;
use Symfony\Component\Process\PhpExecutableFinder;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'admix:install {--composer=global : Caminho absoluto do binario do composer que será utilizado para instalar os pacotes}';

    protected $description = 'Instala as controllers / views / assets do Admix';

    public function __construct()
    {
        parent::__construct();

        if (file_exists(config_path('admix.php'))) {
            $this->setHidden();
        }
    }

    public function handle(): int
    {
        $this->requireComposerDevDependencies();
        $this->updateConfigApp();
        $this->updateConfigAuth();
        $this->publishConfigFiles();
        $this->installHorizon();
        $this->installAnalysisCommands();

        $this->line('');
        $this->components->info('Admix instalado com sucesso.');

        return static::SUCCESS;
    }

    protected function requireComposerDevDependencies(): void
    {
        $packages = [
            'laravel/pint:^1.0',
            'nunomaduro/collision:^6.1',
            'nunomaduro/larastan:^2.5',
            'nunomaduro/phpinsights:^2.8',
            'roave/security-advisories:dev-latest',
            'pestphp/pest:^1.16',
            'pestphp/pest-plugin-laravel:^1.1',
        ];

        (new Process([
                'composer',
                'require',
            ] + $packages + ['--dev'], base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output): void {
                $this->output->write($output);
            });
    }

    protected function updateConfigApp(): void
    {
        collect([
            [
                'key' => 'timezone',
                'from' => 'UTC',
                'to' => 'America/Sao_Paulo',
            ],
            [
                'key' => 'locale',
                'from' => 'en',
                'to' => 'pt_BR',
            ],
            [
                'key' => 'faker_locale',
                'from' => 'en_US',
                'to' => 'pt_BR',
            ],
        ])->each(function ($config): void {
            $this->replaceInFile(
                "'{$config['key']}' => '{$config['from']}'",
                "'{$config['key']}' => '{$config['to']}'",
                config_path('app.php'),
            );
        });
    }

    protected function updateConfigAuth(): void
    {
        $configAuth = file_get_contents(config_path('auth.php'));

        if (Str::contains($configAuth, 'admix-web')) {
            return;
        }

        // guards
        $search = "'web' => [\n            'driver' => 'session',\n            'provider' => 'users',\n        ],";
        $replace = "{$search}
        'admix-web' => [\n            'driver' => 'session',\n            'provider' => 'admix-users',\n        ],
        'admix-api' => [\n            'driver' => 'token',\n            'provider' => 'admix-users',\n        ],";
        $this->replaceInFile($search, $replace, config_path('auth.php'));

        // providers
        $search = "'users' => [\n            'driver' => 'eloquent',\n            'model' => App\Models\User::class,\n        ],";
        $replace = "{$search}
        'admix-users' => [\n            'driver' => 'eloquent',\n            'model' => \Agenciafmd\Admix\Models\User::class,\n        ],        ";
        $this->replaceInFile($search, $replace, config_path('auth.php'));

        // passwords
        $search = "'users' => [\n            'provider' => 'users',\n            'table' => 'password_resets',\n            'expire' => 60,\n            'throttle' => 60,\n        ],";
        $replace = "{$search}
        'admix-users' => [\n            'provider' => 'admix-users',\n            'table' => 'password_resets',\n            'expire' => 60,\n            'throttle' => 60,\n        ],";
        $this->replaceInFile($search, $replace, config_path('auth.php'));
    }

    protected function publishConfigFiles(): void
    {
        $this->callSilent('vendor:publish', [
            '--tag' => 'admix-config',
//            '--force' => true,
        ]);
    }

    protected function installHorizon(): void
    {
        (new Process([
            'php',
            'artisan',
            'horizon:install',
        ], base_path()))
            ->setTimeout(null)
            ->run(function ($type, $output): void {
                $this->output->write($output);
            });

        $search = "return in_array(\$user->email, [\n\n            ]);";
        $replace = 'return true;';
        $this->replaceInFile($search, $replace, app_path('Providers/HorizonServiceProvider.php'));
    }

    protected function installAnalysisCommands(): void
    {
        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages['scripts']['phpstan'] = 'vendor/bin/phpstan analyse';
        $packages['scripts']['pint'] = 'vendor/bin/pint packages -v';
        $packages['scripts']['insights'] = 'vendor/bin/phpinsights analyse packages';

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL
        );
    }

    /**
     * Install Breeze's tests.
     */
    protected function installTests(): void
    {
        (new Filesystem())->ensureDirectoryExists(base_path('tests/Feature/Auth'));

        $stubStack = $this->argument('stack') === 'api' ? 'api' : 'default';

        if ($this->option('pest')) {
            $this->requireComposerPackages('pestphp/pest:^1.16', 'pestphp/pest-plugin-laravel:^1.1');

            (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Feature', base_path('tests/Feature/Auth'));
            (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Unit', base_path('tests/Unit'));
            (new Filesystem())->copy(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Pest.php', base_path('tests/Pest.php'));
        } else {
            (new Filesystem())->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/tests/Feature', base_path('tests/Feature/Auth'));
        }
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param string $after
     * @param string $name
     * @param string $group
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web'): void
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'{$group}' => ["), '],');

        if (! Str::contains($middlewareGroup, $name)) {
            $modifiedMiddlewareGroup = str_replace(
                $after . ',',
                $after . ',' . PHP_EOL . '            ' . $name . ',',
                $middlewareGroup,
            );

            file_put_contents(app_path('Http/Kernel.php'), str_replace(
                $middlewareGroups,
                str_replace($middlewareGroup, $modifiedMiddlewareGroup, $middlewareGroups),
                $httpKernel
            ));
        }
    }

    /**
     * Installs the given Composer Packages into the application.
     *
     * @param mixed $packages
     */
    protected function requireComposerPackages($packages): void
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args(),
            ['--dev']
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output): void {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param bool $dev
     */
    protected static function updateNodePackages(callable $callback, $dev = true): void
    {
        if (! file_exists(base_path('package.json'))) {
            return;
        }

        $configurationKey = $dev ? 'devDependencies' : 'dependencies';

        $packages = json_decode(file_get_contents(base_path('package.json')), true);

        $packages[$configurationKey] = $callback(
            array_key_exists($configurationKey, $packages) ? $packages[$configurationKey] : [],
            $configurationKey
        );

        ksort($packages[$configurationKey]);

        file_put_contents(
            base_path('package.json'),
            json_encode($packages, JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) . PHP_EOL
        );
    }

    /**
     * Delete the "node_modules" directory and remove the associated lock files.
     */
    protected static function flushNodeModules(): void
    {
        tap(new Filesystem(), static function ($files): void {
            $files->deleteDirectory(base_path('node_modules'));

            $files->delete(base_path('yarn.lock'));
            $files->delete(base_path('package-lock.json'));
        });
    }

    /**
     * Replace a given string within a given file.
     */
    protected function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }

    protected function phpBinary(): string
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }

    protected function runCommands(array $commands): void
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> ' . $e->getMessage() . PHP_EOL);
            }
        }

        $process->run(function ($type, $line): void {
            $this->output->write('    ' . $line);
        });
    }
}
