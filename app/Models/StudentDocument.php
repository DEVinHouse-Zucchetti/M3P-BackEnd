<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentDocument extends Model
{
    protected $fillable = [
        'title',
        'file_id',
        'student_id',
    ];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
