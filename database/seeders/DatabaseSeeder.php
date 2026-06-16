<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Project;
use App\Models\Task;
use App\Models\Comment;
use App\Models\Assignment;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
    public function run(): void
{
    //users
    $admin = User::create([
        'name' => 'Admin User',
        'username' => 'admin',
        'role' => 'admin',
        'password' => bcrypt('admin'),
    ]);

    $user1 = User::create([
        'name' => 'John Doe',
        'username' => 'john',
        'role' => 'employee',
        'password' => bcrypt('john'),
    ]);

    $user2 = User::create([
        'name' => 'Jane Smith',
        'username' => 'jane',
        'role' => 'privileged',
        'password' => bcrypt('jane'),
    ]);

    //projects
    $project1 = Project::create([
        'title' => 'Make salad',
        'creator_id' => $admin->id,
    ]);

    $project2 = Project::create([
        'title' => 'Bake potatoes',
        'creator_id' => $user2->id,
    ]);

    //tasks
    $task1 = Task::create([
        'title' => 'Cut lettuce',
        'description' => 'Cut greens',
        'status' => 'To Do',
        'deadline' => now()->addDays(7),
        'creator_id' => $admin->id,
        'project_id' => $project1->id,
    ]);

    $task2 = Task::create([
        'title' => 'Cook meat',
        'description' => 'In oven',
        'status' => 'In Progress',
        'deadline' => now()->addDays(10),
        'creator_id' => $user1->id,
        'project_id' => $project2->id,
    ]);

    //comments
    Comment::create([
        'content' => 'This looks good!',
        'task_id' => $task1->id,
        'creator_id' => $user1->id,
    ]);

    Comment::create([
        'content' => 'I will start doing this.',
        'task_id' => $task2->id,
        'creator_id' => $user2->id,
    ]);

    // assignments
    Assignment::create([
        'task_id' => $task1->id,
        'from_id' => $admin->id,
        'to_id' => $user1->id,
    ]);

    Assignment::create([
        'task_id' => $task2->id,
        'from_id' => $user1->id,
        'to_id' => $user2->id,
    ]);
}}
