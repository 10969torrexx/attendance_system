<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [
        'id', 
        'first_name', 
        'last_name', 
        'birth_date', 
        'with_class', 
        'class_id', 
        'created_at', 
        'updated_at'
    ];

}
