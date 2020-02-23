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
}
