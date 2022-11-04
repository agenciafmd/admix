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
        $this->requireComposerPackages([
            'pestphp/pest:^1.16',
            'pestphp/pest-plugin-laravel:^1.1',
            'laravel/horizon:^5.7',
        ]);
        $this->call('horizon:install');
        $this->updateConfigHorizon();

        $this->updateConfigApp();
        $this->updateConfigAuth();


        $this->line('');
        $this->components->info('Admix instalado com sucesso.');

        return static::SUCCESS;
    }

    protected function updateConfigHorizon(): void
    {
        //
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
        ])->each(function ($config) {
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

    /**
     * Install Breeze's tests.
     *
     * @return void
     */
    protected function installTests()
    {
        (new Filesystem)->ensureDirectoryExists(base_path('tests/Feature/Auth'));

        $stubStack = $this->argument('stack') === 'api' ? 'api' : 'default';

        if ($this->option('pest')) {
            $this->requireComposerPackages('pestphp/pest:^1.16', 'pestphp/pest-plugin-laravel:^1.1');

            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Feature', base_path('tests/Feature/Auth'));
            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Unit', base_path('tests/Unit'));
            (new Filesystem)->copy(__DIR__ . '/../../stubs/' . $stubStack . '/pest-tests/Pest.php', base_path('tests/Pest.php'));
        } else {
            (new Filesystem)->copyDirectory(__DIR__ . '/../../stubs/' . $stubStack . '/tests/Feature', base_path('tests/Feature/Auth'));
        }
    }

    /**
     * Install the middleware to a group in the application Http Kernel.
     *
     * @param string $after
     * @param string $name
     * @param string $group
     * @return void
     */
    protected function installMiddlewareAfter($after, $name, $group = 'web')
    {
        $httpKernel = file_get_contents(app_path('Http/Kernel.php'));

        $middlewareGroups = Str::before(Str::after($httpKernel, '$middlewareGroups = ['), '];');
        $middlewareGroup = Str::before(Str::after($middlewareGroups, "'$group' => ["), '],');

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
     * @return void
     */
    protected function requireComposerPackages($packages)
    {
        $composer = $this->option('composer');

        if ($composer !== 'global') {
            $command = ['php', $composer, 'require'];
        }

        $command = array_merge(
            $command ?? ['composer', 'require'],
            is_array($packages) ? $packages : func_get_args()
        );

        (new Process($command, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output) {
                $this->output->write($output);
            });
    }

    /**
     * Update the "package.json" file.
     *
     * @param callable $callback
     * @param bool $dev
     * @return void
     */
    protected static function updateNodePackages(callable $callback, $dev = true)
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
     *
     * @return void
     */
    protected static function flushNodeModules()
    {
        tap(new Filesystem, function ($files) {
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

    /**
     * Get the path to the appropriate PHP binary.
     *
     * @return string
     */
    protected function phpBinary()
    {
        return (new PhpExecutableFinder())->find(false) ?: 'php';
    }

    /**
     * Run the given commands.
     *
     * @param array $commands
     * @return void
     */
    protected function runCommands($commands)
    {
        $process = Process::fromShellCommandline(implode(' && ', $commands), null, null, null, null);

        if ('\\' !== DIRECTORY_SEPARATOR && file_exists('/dev/tty') && is_readable('/dev/tty')) {
            try {
                $process->setTty(true);
            } catch (RuntimeException $e) {
                $this->output->writeln('  <bg=yellow;fg=black> WARN </> ' . $e->getMessage() . PHP_EOL);
            }
        }

        $process->run(function ($type, $line) {
            $this->output->write('    ' . $line);
        });
    }
}