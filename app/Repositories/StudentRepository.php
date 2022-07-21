<?php

namespace App\Repositories;

use App\Models\Student;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\StudentContract;

class StudentRepository extends BaseRepository implements StudentContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Student $models)
    {
        $this->model = $models->whereNotNull('id');
    }
}
