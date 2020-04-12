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
            return $this->false('Call FB API failed.');
        }
        $datas = $response->data;

        foreach ($datas as $data) {
            $friend = [
                'fbid' => $data->id,
                'name' => $data->name,
                'gender' => $data->gender ?? null,
                'avatar' => $data->picture->data->url ?? null,
                'unfriend_at' => null,
            ];
            $this->model->updateOrCreate(['fbid' => $data->id], $friend);
        }
        $unf = $this->checkUnfriend($datas);

        return $this->true($unf);
    }

    /**
     * @inheritDoc
     */
    public function autoLike()
    {
        // Get list crushes by timer
        $crush = $this->model->where('timer', now()->format('H'))->first();
        if (!$crush) {
            return;
        }

        // Get latest post of crush
        $post = $this->callApi($crush->fbid, 'posts', '&fields=id&limit=2');
        if (empty($post->data[0])) {
            return;
        }
        $latestPostId = $post->data[0]->id;
        // Check post liked
        if ($this->checkLiked($latestPostId)) {
            return;
        }

        // Send like
        $like = $this->callApi($latestPostId, 'likes', '&method=POST');
        // Write log
        if ($like->success) {
            $this->writeLog('like', 'success', null, $latestPostId);
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

    /**
     * From list friend on database,
     * map with the new friend list to find out which record is not existed in new list.
     * @param array $new
     */
    private function checkUnfriend(array $new)
    {
        $currentList = $this->model->whereNull('unfriend_at')->pluck('fbid');
        $newList = collect($new)->pluck('id');
        $diff = $currentList->diff($newList)->all();

        // Update unfriend_at
        $this->model->whereIn('fbid', $diff)
            ->update(['unfriend_at' => now()]);

        // Write log
        foreach ($diff as $item) {
            $name = $this->model->where('fbid', $item)->value('name');
            $this->writeLog('friend', 'danger', $name, $item);
        }
    }

    /**
     * @inheritDoc
     */
    public function getFriendsOnLocal($search = null, $showAuto = false)
    {
        return $this->model
            ->when($search, function () use ($search) {
                return $this->model->fullTextSearch('name', $search);
            })
            ->when($showAuto === 'true', function() {
                return $this->model->whereNotNull('timer')->orderBy('timer');
            })
            ->whereNull('unfriend_at')
            ->orderByDesc('id')
            ->paginate(20);
    }

    /**
     * @inheritDoc
     */
    public function getLogs($skip = 0)
    {
        return $this->modelFbLog->newQuery()->orderByDesc('id')->skip($skip)->take(10)->get();
    }

    /**
     * @inheritDoc
     */
    public function getTimer()
    {
        $timer = $this->model->whereNotNull('timer')->pluck('timer')->all();
        $range = range(7, 22);
        $diff = array_diff($range, $timer);
        $result = [];
        foreach ($range as $item) {
            $result[] = [
                'value' => $item,
                'text' => sprintf('%02d', $item),
                'disabled' => !in_array($item, $diff)
            ];
        }
        return $result;
    }

    /**
     * @inheritDoc
     */
    public function updateTimer($id, $timer)
    {
        // Remove current timer
        $this->model->where('timer', $timer)->update(['timer' => null]);

        // Update to new friend
        return $this->model->find($id)->update(['timer' => $timer]);
    }
}
