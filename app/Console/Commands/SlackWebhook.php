<?php

namespace App\Console\Commands;

use App\Repositories\SlackWebhookRepositoryInterface;
use Illuminate\Console\Command;

class SlackWebhook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tvqhub:slack-webhook';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send messages to Slack via Incoming webhook';

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
        app(SlackWebhookRepositoryInterface::class)->getQuoteOfDay();
    }
}
