<?php

namespace App\Repositories;

use App\Helpers\HGuzzle;
use App\Models\FbFriend;
use App\Models\FbLog;
use App\Models\LarOption;
use App\Repositories\Base\BaseRepository;
use App\Repositories\FacebookerRepositoryInterface;

class FacebookerRepository extends BaseRepository implements FacebookerRepositoryInterface
{
    const GRAPH_VERSION = 'https://graph.facebook.com/v6.0/';

    /** @var FbLog  */
    protected $modelFbLog;

    /**
     * FacebookerRepository constructor.
     *
     * @param FbFriend $model
     * @param FbLog $modelFbLog
     */
    public function __construct(FbFriend $model, FbLog $modelFbLog)
    {
        parent::__construct($model);
        $this->modelFbLog = $modelFbLog;
    }

    /**
     * @inheritDoc
     */
    public function getFriends()
    {
        // Call API
        $response = $this->callApi('me', 'friends', '&fields=name,picture.width(2048){url},gender&pretty=0&limit=5000');
        if (!$response) {
            return $this->returnFalse('Call API failed.');
        }
        $datas = $response->data;

        // TODO: check unfriended

        foreach ($datas as $data) {
            $friend = [
                'fbid' => $data->id,
                'name' => $data->name,
                'gender' => $data->gender ?? null,
                'avatar' => $data->picture->data->url ?? null,
            ];
            $this->model->updateOrCreate(['fbid' => $data->id], $friend);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function autoLike()
    {
        // Get list crushes
        $crushes = $this->model->where('is_crush', 1)->get();

        foreach ($crushes as $crush) {
            // Get latest post of crush
            $post = $this->callApi($crush->fbid, 'posts', '&fields=id&limit=2');
            if (empty($post->data[0])) {
                continue;
            }
            $latestPostId = $post->data[0]->id;
            // Check post liked
            if ($this->checkLiked($latestPostId)) {
                continue;
            }

            // Send like
            $like = $this->callApi($latestPostId, 'likes', '&method=POST');

            // Write log
            if ($like->success) {
                $this->writeLog('like', 'success', null, $latestPostId);
            }
        }
    }

    /**
     * Get access token from LarOptions.
     *
     * @return mixed
     */
    private function getAccessToken()
    {
        return LarOption::where('key', 'fb_access_token')->value('value');
    }

    /**
     * Call Facebook Graph.
     * @see https://developers.facebook.com/docs/graph-api/reference
     *
     * @param $node
     * @param $edges
     * @param $fields
     * @return mixed
     */
    private function callApi($node, $edges, $fields)
    {
        $fbAccessToken = $this->getAccessToken();
        $url = self::GRAPH_VERSION . $node . '/' . $edges . '?access_token=' . $fbAccessToken . $fields;
        return app(HGuzzle::class)->send('GET', $url);
    }

    /**
     * Write log for Facebooker.
     *
     * @param $type
     * @param $alert
     * @param $content
     * @param null $postId
     */
    private function writeLog($type, $alert, $content = null, $postId = null)
    {
        $this->modelFbLog->create([
            'type' => $type,
            'alert' => $alert,
            'content' => $content,
            'post_id' => $postId
        ]);
    }

    /**
     * Check post liked by reading log.
     *
     * @param $postId
     * @return mixed
     */
    private function checkLiked($postId)
    {
        return $this->modelFbLog->where([
            'type' => 'like',
            'post_id' => $postId
        ])->first();
    }
}