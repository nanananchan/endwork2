<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TaskCard extends Component
{
    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function render(): View|Closure|string
    {
        return view('components.task-card');
    }
}