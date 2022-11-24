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

    protected $appends = [
        'end_day',
    ];

    protected $hidden = [];


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

    public function getEndDayAttribute()
    {
        return (new Carbon($this->end_date))->diffInDays() + 2;
    }
}
