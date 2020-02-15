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

    /**
     * Check origin url has existed in system yet.
     *
     * @param string $originUrl
     * @return mixed
     */
    public function checkOriginLinkExisted(string $originUrl);
}
