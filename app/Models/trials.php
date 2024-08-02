<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class trials extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $fillable = [
        'id',
        'code',
        'index',
        'keys',
        'status',
        'type',
        'settings',
    ];
}
