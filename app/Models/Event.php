<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'event_name',
        'start_date',
        'end_date',
    ];

    //リレーションの定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //リレーションの定義
    public function task()
    {
        return $this->belongsTo(User::class);
    }

    // public function start_diff()
    // {
    //     return (new Carbon($this->end_date))->diffForHumans();
    // }
}
