<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class folders extends Model
{
    use HasFactory;
    use SoftDeletes;
     protected $fillable = [
        'id',
        'uuid',
        'project_id',
        'user_id',
        'folder_id',
        'folder_name',
        'code',
        'settings'
    ];

 
}
