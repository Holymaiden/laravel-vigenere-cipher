<?php

namespace App\Repositories;

use App\Models\ClassStudent;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\ClassStudentContract;

class ClassStudentRepository extends BaseRepository implements ClassStudentContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(ClassStudent $models)
    {
        $this->model = $models->whereNotNull('id');
    }
}
