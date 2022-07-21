<?php

namespace App\Repositories;

use App\Models\Setting;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\SettingContract;

class SettingRepository extends BaseRepository implements SettingContract
{
    /**
     * @var
     */
    protected $model;

    public function __construct(Setting $models)
    {
        $this->model = $models->whereNotNull('id');
    }
}
