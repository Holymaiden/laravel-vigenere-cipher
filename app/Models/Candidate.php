<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;
    // protected $table = 'role';
    protected $fillable = [
        'student_id',
        'student_vice_id',
        'vision',
        'mission',
        'image',
    ];

    public function student()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_id');
    }

    public function studentVice()
    {
        return $this->hasOne('App\Models\Student', 'id', 'student_vice_id');
    }
}
