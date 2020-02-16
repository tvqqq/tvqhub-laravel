<?php

namespace App\Jobs;

use App\Repositories\UrlRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UrlTracking implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $urlId;
    public $ip;
    public $userAgent;

    /**
     * Create a new job instance.
     *
     * @param $urlId
     * @param $ip
     * @param $userAgent
     */
    public function __construct($urlId, $ip, $userAgent)
    {
        $this->urlId = $urlId;
        $this->ip = $ip;
        $this->userAgent = $userAgent;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->delete();

        app(UrlRepositoryInterface::class)->tracking($this->urlId, $this->ip, $this->userAgent);
    }
}
