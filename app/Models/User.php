<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Assignment;

class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'username',
        'role',
        'password'
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    // RELATIONS

    public function projects()
    {
        return $this->hasMany(Project::class, 'creator_id', 'user_id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'creator_id', 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'creator_id', 'user_id');
    }

    public function sentAssignments()
    {
        return $this->hasMany(Assignment::class, 'from_id', 'user_id');
    }

    public function receivedAssignments()
    {
        return $this->hasMany(Assignment::class, 'to_id', 'user_id');
    }

    public function assignedTasks()
    {
        return $this->hasMany(Task::class, 'assigned_to', 'user_id');
    }


    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isPrivileged()
    {
        return $this->role === 'privileged';
    }

    public function isEmployee()
    {
        return $this->role === 'employee';
    }

    public function canManageTasks()
    {
        return $this->isAdmin() || $this->isPrivileged();
    }
}