<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        dispatch(function () {
            SitemapGenerator::create(config('app.url'))
                ->getSitemap()
                ->writeToDisk(config('filesystems.default'), 'sitemap.xml');
        })->onQueue('low');
    }
}
