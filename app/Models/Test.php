<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'logic_score',
        'numeric_score',
        'verbal_score',
        'numeric_status',
        'verbal_status',
        'logic_status',
        'numeric_timer',
        'verbal_timer',
        'logic_timer',
        'result'
    ];
}
