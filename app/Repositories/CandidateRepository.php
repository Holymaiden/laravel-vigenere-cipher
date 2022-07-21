<?php

namespace App\Repositories;

use App\Models\Candidate;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\CandidateContract;

class CandidateRepository extends BaseRepository implements CandidateContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Candidate $models)
    {
        $this->model = $models->whereNotNull('id');
    }
}
