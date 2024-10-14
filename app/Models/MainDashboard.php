<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainDashboard extends Model
{
    use HasFactory;
    use SoftDeletes;
   
    protected function casts(): array{
        return [
            'instructions' => 'array',
             'warnings' => 'array',
                'headers' => 'array',
                'images' => 'array',
                 'footers' => 'array',
        ];
    }

     protected $fillable = [
        'id',
        'code',
        'instructions',
        'warnings',
        'status',
        'headers',
        'test_name',
         'images',
          'footers',
          'uuid',
             'user_id',
               'createby'

    ];

     public function MainDash(){
         return $this->hasMany(MainDashboard::class);
    }
}
 