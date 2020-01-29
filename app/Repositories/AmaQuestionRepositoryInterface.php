<?php

namespace App\Repositories;

use App\Repositories\Base\BaseRepositoryInterface;

interface AmaQuestionRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Get all records sorted by latest with trashed.
     *
     * @return mixed
     */
    public function getLatestWithTrashed();

    /**
     * Get lasted anwsered questions.
     *
     * @return mixed
     */
    public function getLatestAnsweredQuestion();

    /**
     * Count questions without replied yet.
     *
     * @return mixed
     */
    public function countNoReply();
}
