<x-layout title="Projects">

  <div class="row g-4 align-items-start">

    <!-- LEFT: Projects panel -->
    <div class="col-3">
      <div class="bg-white border">

        <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-light">
          <strong>Projects</strong>
          @if(auth()->user()->isAdmin())
            <a href="{{ route('projects.create') }}" class="btn btn-sm btn-outline-secondary">+</a>
          @endif
        </div>

        <div class="p-2">
          @foreach($projects as $project)
            <x-project-card
              :project="$project"
              :active="$loop->first"
            />
          @endforeach
        </div>

      </div>
    </div>

    <!-- RIGHT: Tasks panel -->
    <div class="col-9">
      <div class="bg-white border">

        <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom bg-light">
          <strong>
            Tasks //
            <span id="project-title">
              {{ $projects->first()->title ?? 'Current project' }}
            </span>
          </strong>

          @if(auth()->user()->canManageTasks())
<a href="{{ $projects->first() ? route('tasks.create', $projects->first()) : '#' }}"
   id="add-task-btn"
   class="btn btn-sm btn-outline-secondary">
    +
</a>          @endif
        </div>

        <div id="project-placeholder"
             class="p-3 text-muted {{ $projects->isEmpty() ? '' : 'd-none' }}">
          Select a project to view its tasks.
        </div>

        <div id="task-list"
             class="p-3 {{ $projects->isEmpty() ? 'd-none' : '' }}">

          @foreach($projects as $project)

            <div class="project-tasks {{ $loop->first ? '' : 'd-none' }}"
                 data-project-id="{{ $project->id }}">

              @forelse($project->tasks as $task)

                <x-task-card :task="$task" />

              @empty

                <p class="text-muted small">
                  No tasks for {{ $project->title }} yet.
                </p>

              @endforelse

            </div>

          @endforeach

        </div>

      </div>
    </div>

  </div>

  <x-slot name="scripts">
    <script>
      document.querySelectorAll('.project-row').forEach(row => {
        row.addEventListener('click', function(e) {
          if (e.target.tagName === 'BUTTON' || e.target.tagName === 'A') return;

          document.querySelectorAll('.project-row').forEach(r => {
            r.classList.remove('active', 'bg-light');
          });

          document.querySelectorAll('.task-sublist').forEach(s => {
            s.classList.add('d-none');
          });

          this.classList.add('active', 'bg-light');

          const sublist = this.nextElementSibling;

          if (sublist && sublist.classList.contains('task-sublist')) {
            sublist.classList.remove('d-none');
          }

          const projectId = this.dataset.projectId;

          document.getElementById('project-title').textContent =
            this.dataset.projectName;

          document.getElementById('project-placeholder')
            .classList.add('d-none');

          document.getElementById('task-list')
            .classList.remove('d-none');

          document.querySelectorAll('.project-tasks').forEach(pt => {
            pt.classList.toggle(
              'd-none',
              pt.dataset.projectId !== projectId
            );
          });

          const addTaskBtn = document.getElementById('add-task-btn');

          if (addTaskBtn) {
            addTaskBtn.href = `/projects/${projectId}/tasks/create`;
          }
        });
      });

      const firstActive = document.querySelector('.project-row.active');
      const addTaskBtn = document.getElementById('add-task-btn');

      if (firstActive && addTaskBtn) {
        addTaskBtn.href =
          `/projects/${firstActive.dataset.projectId}/tasks/create`;
      }
    </script>
  </x-slot>

</x-layout>