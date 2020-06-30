<?php

namespace App\Console\Commands;

use App\Repositories\FacebookerRepositoryInterface;
use Illuminate\Console\Command;

class FbAutoLike extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tvqhub:fb-autolike';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Auto like crushes\'s posts';

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
        // TODO: make a setting enable this function
        // app(FacebookerRepositoryInterface::class)->autoLike();
    }
}
