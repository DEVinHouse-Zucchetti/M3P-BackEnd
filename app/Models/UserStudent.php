<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'student_id'
    ];

    protected $table = 'users_students';

    protected $hidden = ['created_at', 'updated_at'];



    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
