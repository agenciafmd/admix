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
        $this->call('auth:clear-resets');
        $this->call('cache:clear');
        $this->call('clockwork:clean', [
            '--all' => 'true',
        ]);
        $this->call('config:clear');
        $this->call('event:clear');
        $this->call('notifications:clear');
        $this->call('optimize:clear');
        $this->call('page-cache:clear');
        $this->call('route:clear');
        $this->call('view:clear');
        $this->line('');
        $this->line('+-------------------------------+');
        $this->line('+-- Gerando arquivos de cache --+');
        $this->line('+-------------------------------+');
        $this->call('config:cache');
        $this->call('event:cache');
        $this->call('route:cache');
        $this->call('view:cache');
        $this->line('');
        $this->line('+-------------------------------+');
        $this->line('+--- Otimizando os serviços ----+');
        $this->line('+-------------------------------+');
        $this->call('queue:restart');
    }
}
