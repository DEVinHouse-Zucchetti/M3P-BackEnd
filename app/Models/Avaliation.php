<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliation extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'date', 'weight', 'height', 'age', 'observations_to_student', 'observations_to_nutritionist', 'file_id', 'measures'];

    protected $casts = [
        'measures' => 'array',
    ];

    public function Student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function file() {
        return $this->belongsTo(File::class, 'file_id');
    }
}
