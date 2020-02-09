<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface SlackWebhookRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Quote Of Day.
     * @return mixed
     */
    public function getQuoteOfDay();
}
