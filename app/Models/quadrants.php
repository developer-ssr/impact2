<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class quadrants extends Model
{
    use HasFactory;
  
     protected $fillable = [
        'grid_name',
        'key',
        'rows',
        'settings',
    ];
}
