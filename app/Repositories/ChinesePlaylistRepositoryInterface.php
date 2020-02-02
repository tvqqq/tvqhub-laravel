<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface ChinesePlaylistRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get the time that added a new song.
     *
     * @return string
     */
    public function getTimeLastUpdated();
}
