<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'id', 
        'class_id', 
        'student_id', 
        'remarks', 
        'month', 
        'year', 
        'created_at', 
        'updated_at'
    ];
}
