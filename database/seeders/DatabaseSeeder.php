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
    // USERS
    $admin = User::create([
        'name' => 'Admin User',
        'username' => 'admin',
        'role' => 'admin',
        'password' => bcrypt('password'),
    ]);

    $user1 = User::create([
        'name' => 'John Doe',
        'username' => 'john',
        'role' => 'employee',
        'password' => bcrypt('password'),
    ]);

    $user2 = User::create([
        'name' => 'Jane Smith',
        'username' => 'jane',
        'role' => 'privileged',
        'password' => bcrypt('password'),
    ]);

    // PROJECTS
    $project1 = Project::create([
        'title' => 'Website Redesign',
        'creator_id' => $admin->id,
    ]);

    $project2 = Project::create([
        'title' => 'Mobile App',
        'creator_id' => $user1->id,
    ]);

    // TASKS
    $task1 = Task::create([
        'title' => 'Design UI',
        'description' => 'Create new UI mockups',
        'status' => 'To Do',
        'deadline' => now()->addDays(7),
        'creator_id' => $admin->id,
        'project_id' => $project1->id,
    ]);

    $task2 = Task::create([
        'title' => 'Build API',
        'description' => 'Develop REST API',
        'status' => 'In Progress',
        'deadline' => now()->addDays(10),
        'creator_id' => $user1->id,
        'project_id' => $project2->id,
    ]);

    // COMMENTS
    Comment::create([
        'content' => 'This looks good!',
        'task_id' => $task1->id,
        'creator_id' => $user1->id,
    ]);

    Comment::create([
        'content' => 'I will start working on this.',
        'task_id' => $task2->id,
        'creator_id' => $user2->id,
    ]);

    // ASSIGNMENTS
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
