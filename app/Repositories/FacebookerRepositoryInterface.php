<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface FacebookerRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get list friend on Facebook.
     *
     * @return mixed
     */
    public function getFriends();

    /**
     * Auto like crushes's posts.
     *
     * @return mixed
     */
    public function autoLike();

    /**
     * Get list friend on local DB
     * @param string $seach
     */
    public function getFriendsOnLocal($seach = null);

    /**
     * Get list friend on local DB
     * @param int $skip
     */
    public function getLogs($skip = 0);
}
