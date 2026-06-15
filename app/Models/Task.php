<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'title',
        'description',
        'status',
        'deadline',
        'creator_id',
        'project_id',
    ];
    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'task_id');
    }
    public function assignments()
    {
        return $this->hasMany(Assignment::class, 'task_id');
    }
    public function isAssignedTo(User $user): bool
    {
        return $this->assignments()
            ->where('to_id', $user->id)
            ->exists();
    }
}
