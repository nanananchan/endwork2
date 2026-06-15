<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = [
        'content',
        'task_id',
        'creator_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
}
