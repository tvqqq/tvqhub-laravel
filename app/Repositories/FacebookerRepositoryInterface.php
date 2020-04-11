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
     * @param null $seach
     */
    public function getFriendsOnLocal($seach = null);
}
