<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Tests extends Model
{
  use HasFactory;
    use SoftDeletes;

     protected function casts(): array{
        return [
            'options' => 'array',
             'quadrants' => 'array',
                'settings' => 'array',
        ];
    }
    
     protected $fillable = [
        'id',
        'uuid',
        'test_name',
        'status',
        'code',
        'user_id',
        'settings',
        'quadrants',
    ];
}
