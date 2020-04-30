<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class AdmixMediaClear extends Command
{
    protected $signature = 'admix:media-clear';

    protected $description = 'Remove os thumbs gerados pela aplicação';

    public function handle()
    {
        if (File::deleteDirectory(public_path('/media'), true)) {
            $this->info('Thumbs removidos com sucesso');
        } else {
            $this->info('Falha na remoção dos thumbs');
        }
    }
}
