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
     * @param bool $showAuto
     */
    public function getFriendsOnLocal($seach = null, bool $showAuto = false);

    /**
     * Get list friend on local DB
     * @param int $skip
     */
    public function getLogs($skip = 0);

    /**
     * Get timer auto like available for select
     */
    public function getTimer();

    /**
     * Update timer auto like of friend
     * @param int $id
     * @param int|null $timer
     */
    public function updateTimer($id, $timer);
}
