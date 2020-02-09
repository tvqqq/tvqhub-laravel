<?php

namespace App\Repositories;

use App\Helpers\HGuzzle;
use App\Models\SlackWebhook;
use App\Repositories\Base\BaseRepository;
use App\Repositories\SlackWebhookRepositoryInterface;

class SlackWebhookRepository extends BaseRepository implements SlackWebhookRepositoryInterface
{
    /**
     * SlackWebhookRepository constructor.
     *
     * @param SlackWebhook $model
     */
    public function __construct(SlackWebhook $model)
    {
        parent::__construct($model);
    }

    /**
     * Send slack message into webhook.
     *
     * @param $data
     * @return mixed
     */
    private function sendSlackMsg($data)
    {
        app(HGuzzle::class)->send(
            'POST',
            config('tvqhub.slack_webhook'),
            ['body' => json_encode($data)]
        );
    }

    /**
     * @inheritDoc
     */
    public function getQuoteOfDay()
    {
        $json = file_get_contents('https://quotes.rest/qod.json');
        $obj = json_decode($json, true);
        $quotes = $obj['contents']['quotes'][0];
        $text = $quotes['quote'] . ' - ' . $quotes['author'];

        $this->sendSlackMsg(['text' => $text]);
    }
}
