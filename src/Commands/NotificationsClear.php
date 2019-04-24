<?php

namespace Agenciafmd\Admix\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NotificationsClear extends Command
{
    protected $signature = 'notifications:clear
        {--days=30 : Days to keep the notifications}';

    protected $description = 'Remove notification more than x days';

    public function handle()
    {
        DB::table('notifications')->where('created_at', '<=', Carbon::now()->subDays($this->option('days')))->delete();

        $this->info('Notificações removidas');
    }
}
