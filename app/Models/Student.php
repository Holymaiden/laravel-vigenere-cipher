<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'nisn',
        'name',
        'class_id',
        'jkl'
    ];

    public function class()
    {
        return $this->hasOne('App\Models\ClassStudent', 'id', 'class_id');
    }
}
