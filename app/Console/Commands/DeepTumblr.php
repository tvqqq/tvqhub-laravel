<?php

namespace App\Console\Commands;

use Deep\Controllers\DeepController;
use Illuminate\Console\Command;

class DeepTumblr extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tvqhub:deep-tumblr';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cron Tumblr newest post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        app(DeepController::class)->cron();
    }
}
