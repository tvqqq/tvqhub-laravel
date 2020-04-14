<?php

namespace App\Repositories;

use App\Models\SlackWebhook;
use App\Repositories\Base\BaseRepository;
use App\Repositories\SlackWebhookRepositoryInterface;
use Google\Cloud\Translate\V2\TranslateClient;
use Helper;
use Opt;

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
        Helper::guzzle(
            'POST',
            Opt::get('slack_general_webhook'),
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
        $quoteText = $quotes['quote'] . ' - ' . $quotes['author'];

        // Translate to Vietnamese
        $translateClient = new TranslateClient([
            'key' => Opt::get('google_api_key')
        ]);
        $translate = $translateClient->translate($quotes['quote'], [
            'source' => 'en',
            'target' => 'vi'
        ]);

        $text = $quoteText . "\n" . '(Google dịch: ' . $translate['text'] . ')';
        $this->sendSlackMsg(['text' => $text]);
    }
}
