<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    //リレーションの定義
    public function task()
    {
        return $this->hasMany(Task::class);
    }
}
