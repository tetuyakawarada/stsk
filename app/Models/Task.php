<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'event_id',
        'subject_id',
        'total_page',
        'page_time',
    ];

    //リレーションの定義
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function getTotalTimeAttribute()
    {
        return $this->total_page * $this->page_time;
    }

    public function getProgressTimeAttribute()
    {
        return $this->finish_page * $this->page_time;
    }

    public function getDegreeTimeAttribute()
    {
        return $this->finish_page / $this->total_page * 100;
    }
}
