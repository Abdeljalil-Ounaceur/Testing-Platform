<?php

namespace App\Models;

use Faker\Core\File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'titre',
        'durree',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
