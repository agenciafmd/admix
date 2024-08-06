<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Process\Process;

class InstallCommand extends Command
{
    protected $signature = 'admix:install';

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
        $this->updateConfigAuth();
        $this->updateConfigFilesystems();
        //        $this->publishViewFiles();
        $this->publishConfigFiles();
        $this->publishLangFiles();
        $this->installHorizon();
        $this->installAnalysisCommands();

        $this->line('');
        $this->components->info('Admix instalado com sucesso.');

        return static::SUCCESS;
    }

    private function requireComposerDevDependencies(): void
    {
        $allowedPlugins = [
            'dealerdirect/phpcodesniffer-composer-installer',
            'pestphp/pest-plugin-laravel',
        ];

        foreach ($allowedPlugins as $plugin) {
            (new Process([
                'composer',
                'config',
                '--no-plugins',
                'allow-plugins.' . $plugin,
                'true',
            ], base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
                ->setTimeout(null)
                ->run(function ($type, $output): void {
                    $this->output->write($output);
                });
        }

        $packages = [
            'barryvdh/laravel-ide-helper:^3.0',
            'brianium/paratest:^6.0',
            'larastan/larastan:^2.5',
            'nunomaduro/phpinsights:^2.8',
            'pestphp/pest-plugin-laravel:^2.2',
            'pestphp/pest:^2.19',
            'roave/security-advisories:dev-latest',
            '--dev', // install packages as dev dependencies
        ];

        (new Process([
                'composer',
                'require',
            ] + $packages, base_path(), ['COMPOSER_MEMORY_LIMIT' => '-1']))
            ->setTimeout(null)
            ->run(function ($type, $output): void {
                $this->output->write($output);
            });
    }

    private function updateConfigAuth(): void
    {
        $configAuth = file_get_contents(config_path('auth.php'));

        if (Str::contains($configAuth, 'admix-web')) {
            return;
        }

        // guards
        $search = "'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],";
        $replace = "{$search}
        'admix-web' => [
            'driver' => 'session',
            'provider' => 'admix-users',
        ],";
        $this->replaceInFile($search, $replace, config_path('auth.php'));

        // providers
        $search = "'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],";
        $replace = "{$search}
        'admix-users' => [
            'driver' => 'eloquent',
            'model' => \Agenciafmd\Admix\Models\User::class,
        ],";
        $this->replaceInFile($search, $replace, config_path('auth.php'));

        // passwords
        $search = "'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],";
        $replace = "{$search}
        'admix-users' => [
            'provider' => 'admix-users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],";
        $this->replaceInFile($search, $replace, config_path('auth.php'));
    }

    private function updateConfigFilesystems(): void
    {
        $configAuth = file_get_contents(config_path('filesystems.php'));

        if (Str::contains($configAuth, 'cdn')) {
            return;
        }

        $search = "'s3' => [";
        $replace = "'cdn' => [
            'driver' => 'ftp',
            'host' => env('CDN_HOST'),
            'username' => env('CDN_USERNAME'),
            'password' => env('CDN_PASSWORD'),
            'url' => env('CDN_URL'),
            'ssl' => false,
        ],

        {$search}";
        $this->replaceInFile($search, $replace, config_path('filesystems.php'));
    }

    private function publishViewFiles(): void
    {
        $this->callSilent('vendor:publish', [
            '--tag' => 'admix-components:views',
            '--force' => true,
        ]);
    }

    private function publishConfigFiles(): void
    {
        $this->callSilent('vendor:publish', [
            '--tag' => 'admix:config',
            '--force' => true,
        ]);
    }

    private function publishLangFiles(): void
    {
        $this->callSilent('vendor:publish', [
            '--tag' => 'admix:translations',
            '--force' => true,
        ]);
    }

    private function installHorizon(): void
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

    private function installAnalysisCommands(): void
    {
        $packages = json_decode(file_get_contents(base_path('composer.json')), true);

        $packages['scripts']['phpstan'] = 'vendor/bin/phpstan analyse';
        $packages['scripts']['pint'] = 'vendor/bin/pint packages -v';
        $packages['scripts']['insights'] = 'vendor/bin/phpinsights analyse packages';

        $packages['scripts']['post-update-cmd'] = collect($packages['scripts']['post-update-cmd'])
            ->merge([
                '@php artisan ide-helper:generate',
                '@php artisan ide-helper:meta',
                "@php artisan ide-helper:models 'packages/agenciafmd/*/src/Models' --nowrite",
            ])
            ->unique()
            ->values()
            ->toArray();

        file_put_contents(
            base_path('composer.json'),
            json_encode($packages, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL
        );
    }

    private function replaceInFile(string $search, string $replace, string $path): void
    {
        file_put_contents($path, str_replace($search, $replace, file_get_contents($path)));
    }
}
