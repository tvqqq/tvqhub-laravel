<?php

namespace App\Repositories;

use App\Helpers\HGuzzle;
use App\Repositories\Base\BaseRepository;
use App\Url;
use App\UrlDetail;

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
        } while ($this->checkShortLinkExisted($shortLink));

        return $shortLink;
    }

    /**
     * @inheritDoc
     */
    public function checkShortLinkExisted(string $slug)
    {
        return $this->model->where('slug', $slug)->first();
    }

    /**
     * @inheritDoc
     */
    public function checkOriginLinkExisted(string $originUrl)
    {
        return $this->model->where('origin_url', $originUrl)->first();
    }

    public function tracking($urlId, $ip, $userAgent)
    {
        $ipGeoKey = '23d27652d0a542d6adef130815ebce5a';
        $params = [
            'ip' => $ip,
            'user_agent' => $userAgent,
        ];
        $ipGeo = app(HGuzzle::class)->send('GET', 'https://api.ipgeolocation.io/ipgeo?apiKey=' . $ipGeoKey . '&ip=' . $ip);
        if ($ipGeo) {
            $params['ip_tracking'] = [
                'country_code2' => $ipGeo->country_code2,
                'country_name' => $ipGeo->country_name,
                'city' => $ipGeo->city,
                'district' => $ipGeo->district,
                'isp' => $ipGeo->isp
            ];
        }
        UrlDetail::create([
            'url_id' => $urlId,
            'params' => $params
        ]);
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
}
