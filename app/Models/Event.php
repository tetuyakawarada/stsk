<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //リレーションの定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //リレーションの定義
    public function task()
    {
        return $this->hasMany(User::class);
    }
}
