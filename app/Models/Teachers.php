<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'first_name', 'last_name', 'created_at', 'updated_at'];

}
