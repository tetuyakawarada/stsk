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
        'finish_page',
        'page_time',
    ];

    protected $appends = [
        'user_name',
        'subject_name',
        'total_time',
        'progress_time',
        'degree_time',
    ];

    protected $hidden = [
        'user',
        'subject',
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



    public function getUserNameAttribute()
    {
        return $this->user->name;
    }

    public function getSubjectNameAttribute()
    {
        return $this->subject->subject_text;
    }
}
