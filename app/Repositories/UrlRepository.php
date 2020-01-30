<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepository;
use App\Repositories\UrlRepositoryInterface;
use App\Url;

class UrlRepository extends BaseRepository implements UrlRepositoryInterface
{
    /**
     * UrlRepository constructor.
     *
     * @param Url $model
     */
    public function __construct(Url $model)
    {
        parent::__construct($model);
    }

    /**
     * @inheritDoc
     */
    public function createShortLink(string $originUrl)
    {
        $shortLink = null;
        do {
            $shortLink = $this->generateShortLink($originUrl);
        } while (!$this->checkShortLinkExisted($shortLink));

        return $shortLink;
    }

    /**
     * Use algo to build a short link.
     *
     * @param string $originUrl
     * @return false|string
     */
    private function generateShortLink(string $originUrl)
    {
        return substr(base64_encode(md5(now() . $originUrl)), 0, 6);
    }

    /**
     * Check short link generated randomly has existed in system yet.
     *
     * @param string $slug
     * @return mixed
     */
    private function checkShortLinkExisted(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
