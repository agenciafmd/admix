<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;

class AdmixOptimize extends Command
{
    protected $signature = 'admix:optimize';

    protected $description = 'Turbina a aplicação, cacheando tudo';

    public function handle()
    {
        $this->call('admix:clear');

        $this->call('optimize');
        $this->call('event:cache');
        $this->call('view:cache');

        $this->call('queue:restart');
    }
}
