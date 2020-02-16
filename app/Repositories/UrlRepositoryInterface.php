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
     * Check short link generated randomly has existed in system yet.
     *
     * @param string $slug
     * @return mixed
     */
    public function checkShortLinkExisted(string $slug);

    /**
     * Check origin url has existed in system yet.
     *
     * @param string $originUrl
     * @return mixed
     */
    public function checkOriginLinkExisted(string $originUrl);

    /**
     * Tracking record of shorten link.
     *
     * @param $urlId
     * @param $ip
     * @param $userAgent
     * @return mixed
     */
    public function tracking($urlId, $ip, $userAgent);
}
