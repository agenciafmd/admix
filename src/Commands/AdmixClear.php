<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;

class AdmixClear extends Command
{
    protected $signature = 'admix:clear';

    protected $description = 'Limpa todos os caches para facilitar o desenvolvimento';

    public function handle()
    {
        $this->call('optimize:clear');
        $this->call('auth:clear-resets');
        $this->call('event:clear');
        $this->call('notifications:clear');
        $this->call('page-cache:clear');

        $this->line('Cache limpo com sucesso');
    }
}
