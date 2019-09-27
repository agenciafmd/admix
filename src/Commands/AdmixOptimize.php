<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;

class AdmixOptimize extends Command
{
    protected $signature = 'admix:optimize';

    protected $description = 'Turbina a aplicação, limpando tudo e gerando os caches';

    public function handle()
    {
        $this->line('+--------------------------+');
        $this->line('+----- Limpando tudo ------+');
        $this->line('+--------------------------+');
        $this->call('clear-compiled');
        $this->call('clockwork:clean', [
            '--all' => 'true',
        ]);
        $this->call('auth:clear-resets');
        $this->call('cache:clear');
        $this->call('config:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->call('media:clear');
        $this->call('page-cache:clear');
        $this->line('');
        $this->line('+-------------------------------+');
        $this->line('+-- Gerando arquivos de cache --+');
        $this->line('+-------------------------------+');
        $this->call('config:cache');
        $this->call('route:cache');
        $this->line('');
        $this->line('+-------------------------------+');
        $this->line('+--- Otimizando os serviços ----+');
        $this->line('+-------------------------------+');
        $this->call('queue:restart');
    }
}
