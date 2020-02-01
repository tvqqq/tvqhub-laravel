<?php

namespace App\Repositories;

use App\Models\ChinesePlaylist;
use App\Repositories\Base\BaseRepository;
use App\Repositories\ChinesePlaylistRepositoryInterface;

class ChinesePlaylistRepository extends BaseRepository implements ChinesePlaylistRepositoryInterface
{
    /**
     * ChinesePlaylistRepository constructor.
     *
     * @param ChinesePlaylist $model
     */
    public function __construct(ChinesePlaylist $model)
    {
        parent::__construct($model);
    }
}
