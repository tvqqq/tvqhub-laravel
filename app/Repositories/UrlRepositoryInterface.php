<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface UrlRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Create a short link from origin url
     *
     * @param string $originUrl
     * @return mixed
     */
    public function createShortLink(string $originUrl);
}
