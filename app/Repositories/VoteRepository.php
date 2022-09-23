<?php

namespace App\Repositories;

use App\Models\Vote;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\VoteContract;


class VoteRepository extends BaseRepository implements VoteContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Vote $Vote)
    {
        $this->model = $Vote->whereNotNull('id');
    }

    public function reset()
    {
        return $this->model->delete();
    }
}
