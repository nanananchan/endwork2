<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{

    protected $fillable = [
        'task_id',
        'to_id',
        'from_id',
    ];
    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
