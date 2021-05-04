<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\MediaCollections\MediaRepository;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class AdmixMediaClear extends Command
{
    protected bool $isDryRun = false;

    protected $signature = 'admix:media-clear
        {--dry-run : Lista itens a serem removidos sem removê-los}';

    protected $description = 'Remove os arquivos que não estão no media-library';

    public function handle()
    {
        $this->isDryRun = (bool)$this->option('dry-run');

        $this->removeUnusedFiles();

        $this->removeEmptyDirectories();
    }

    private function removeUnusedFiles()
    {
        $this->info('Apagando arquivos que não estão na media-library');

        $files = collect(Storage::allFiles('media'));

        $mediaRepository = new MediaRepository((new Media()));
        $mediaFiles = $mediaRepository->all()
            ->map(function ($item) {
                return $item->name;
            });

        $filesToDelete = $files
            ->filter(function ($item) {
                return !Str::contains($item, '/conversions/');
            })
            ->map(function ($item) {
                return pathinfo($item, PATHINFO_FILENAME);
            })
            ->filter(function ($item) use ($mediaFiles) {
                return !in_array($item, $mediaFiles->toArray());
            });

        if ($filesToDelete->isEmpty()) {
            $this->line('Nenhum arquivo precisa ser apagado');

            return false;
        }

        if (!$this->isDryRun) {
            $this->getOutput()
                ->progressStart($filesToDelete->count());
        }

        $files->each(function ($item) use ($filesToDelete) {
            $filesToDelete->each(function ($deleteItem) use ($item) {
                if (Str::contains($item, $deleteItem)) {
                    if (!$this->isDryRun) {
                        Storage::delete($item);

                        $this->getOutput()
                            ->progressAdvance();
                    } else {
                        $this->info($item);
                    }
                }
            });
        });

        if (!$this->isDryRun) {
            $this->getOutput()
                ->progressFinish();
        }
    }

    private function removeEmptyDirectories()
    {
        $this->info('Apagando pastas vazias');

        $emptyDirectories = collect(Storage::allDirectories('media'))
            ->sortDesc()
            ->filter(function ($item) {
                $files = collect(Storage::allFiles($item));

                if ($files->isEmpty()) {
                    return true;
                }

                return false;
            });

        if ($emptyDirectories->isEmpty()) {
            $this->line('Nenhuma pasta vazia precisa ser apagada');

            return false;
        }

        if (!$this->isDryRun) {
            $this->getOutput()
                ->progressStart($emptyDirectories->count());
        }

        $emptyDirectories->each(function ($item) {
            if (!$this->isDryRun) {
                Storage::deleteDirectory($item);

                $this->getOutput()
                    ->progressAdvance();
            } else {
                $this->info($item);
            }
        });

        if (!$this->isDryRun) {
            $this->getOutput()
                ->progressFinish();
        }
    }
}
