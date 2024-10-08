<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class projects extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $casts = [
    'settings' => 'array',
];

     protected $fillable = [
        'id',
        'uuid',
        'project_name',
        'status',
        'user_id',
        'settings',
    ];
}
