<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Notification;
use Carbon\Carbon;

class ChangeStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exec:change';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cambiar de estado las novedades';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $date = Carbon::now();
        $date = $date->format('m');

      

    }
}
