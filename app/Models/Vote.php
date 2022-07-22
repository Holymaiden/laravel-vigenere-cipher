<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    use HasFactory;
    // protected $table = 'role';
    protected $fillable = [
        'student_id',
        'candidate',
        'hope',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }
}
