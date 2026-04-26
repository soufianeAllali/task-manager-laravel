<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Task Manager - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --accent-primary: #6366f1;
            --accent-secondary: #a855f7;
            --glass-bg: rgba(255, 255, 255, 0.7);
            --glass-border: rgba(255, 255, 255, 0.4);
            --card-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.07);
        }

        body {
            background: var(--bg-gradient);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1e293b;
            padding-bottom: 2rem;
        }

        .navbar-custom {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--glass-border);
            padding: 1rem 0;
            margin-bottom: 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .glass-card {
            background: var(--glass-bg);
            backdrop-filter: blur(8px);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .task-card {
            margin-bottom: 1.5rem;
            border-left: 5px solid transparent;
        }
        .task-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 40px rgba(0,0,0,0.1);
        }
        .task-card.priority-high { border-left-color: #ef4444; }
        .task-card.priority-medium { border-left-color: #f59e0b; }
        .task-card.priority-low { border-left-color: #3b82f6; }

        .btn-premium {
            border-radius: 12px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .btn-create {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: white;
            border: none;
        }
        .btn-create:hover {
            transform: scale(1.05);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
            color: white;
        }

        .status-toggle-link {
            text-decoration: none;
            font-size: 1.4rem;
            transition: transform 0.2s ease;
        }
        .status-toggle-link:hover {
            transform: scale(1.2);
        }
        .status-pending { color: #f59e0b; }
        .status-completed { color: #10b981; }

        .form-control, .form-select {
            border-radius: 12px;
            border: 1px solid var(--glass-border);
            padding: 0.6rem 1rem;
            background: rgba(255, 255, 255, 0.5);
        }
        .form-control:focus {
            background: white;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: var(--accent-primary);
        }

        .badge-priority {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 0.4rem 0.8rem;
            border-radius: 50px;
        }

        .welcome-section {
            padding: 2rem 0;
        }

        .alert-floating {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1050;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            animation: slideIn 0.5s ease;
        }
        @keyframes slideIn {
            from { transform: translateX(100%); }
            to { transform: translateX(0); }
        }
    </style>
</head>
<body>

    @if(session('create') || session('update') || session('delete'))
        <div class="alert alert-success alert-dismissible fade show alert-floating glass-card" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i>
            {{ session('create') ?? session('update') ?? session('delete') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <nav class="navbar navbar-custom">
        <div class="container">
            <a class="navbar-brand fw-bold fs-4" href="#">
                <i class="fa-solid fa-layer-group text-primary me-2"></i>TaskFlow
            </a>
            <div class="d-flex gap-3">
                <a href="{{route('dashboard')}}" class="btn btn-outline-primary btn-premium">
                    <i class="fa-solid fa-gauge"></i> Dashboard
                </a>
                <a href="{{route('tasks.create')}}" class="btn btn-create btn-premium">
                    <i class="fa-solid fa-plus"></i> New Task
                </a>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="glass-card p-4 mb-4">
            <div class="row g-3 align-items-end">
                <div class="col-md-4">
                    <form action="{{route('task.search')}}" method="post">
                        @csrf
                        <label class="form-label fw-600 text-muted small ms-1">SEARCH BY TITLE</label>
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-end-0"><i class="fa-solid fa-magnifying-glass text-muted"></i></span>
                            <input type="text" name="title" class="form-control border-start-0" placeholder="Task name..." value="{{request('title')}}">
                            <button class="btn btn-outline-primary" type="submit">Search</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-3">
                    <form action="{{route('task.filter')}}" method="post">
                        @csrf
                        <label class="form-label fw-600 text-muted small ms-1">STATUS</label>
                        <select name="status" class="form-select" onchange="this.form.submit()">
                            <option value="all" @selected(request('status') == 'all')>All Status</option>
                            <option value="pending" @selected(request('status') == 'pending')>Pending</option>
                            <option value="completed" @selected(request('status') == 'completed')>Completed</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-5">
                    <form action="{{route('task.filterByPriority')}}" method="post">
                        @csrf
                        <label class="form-label fw-600 text-muted small ms-1">PRIORITY LEVEL</label>
                        <div class="d-flex gap-2">
                             <div class="flex-grow-1 d-flex justify-content-between p-1 bg-light rounded-3" style="background: rgba(0,0,0,0.03) !important;">
                                @foreach(['all', 'low', 'medium', 'high'] as $p)
                                    <input type="radio" class="btn-check" name="priority" id="p-{{$p}}" value="{{$p}}" 
                                           autocomplete="off" onchange="this.form.submit()" @checked(request('priority') == $p || (!request('priority') && $p == 'all'))>
                                    <label class="btn btn-sm btn-outline-{{$p == 'all' ? 'secondary' : ($p == 'high' ? 'danger' : ($p == 'medium' ? 'warning' : 'info'))}} rounded-pill" 
                                           for="p-{{$p}}" style="font-size: 0.75rem; padding: 0.25rem 0.75rem;">
                                        {{ucfirst($p)}}
                                    </label>
                                @endforeach
                             </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row">
            @forelse ($tasks as $task)
                <div class="col-md-6 col-lg-4">
                    <div class="glass-card p-4 task-card priority-{{$task->priority}}">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <a href="{{route('task.toggle',$task->id)}}" class="status-toggle-link" title="Click to toggle status">
                                @if($task->status == 'pending')
                                    <i class="fa-regular fa-circle status-pending"></i>
                                @else
                                    <i class="fa-solid fa-circle-check status-completed"></i>
                                @endif
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-link link-dark p-0" type="button" data-bs-toggle="dropdown">
                                    <i class="fa-solid fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end glass-card border-0 shadow">
                                    <li><a class="dropdown-item" href="{{route('tasks.show', $task->id)}}"><i class="fa-solid fa-eye me-2 text-primary"></i>View Details</a></li>
                                    <li><a class="dropdown-item" href="{{route('tasks.edit',$task->id)}}"><i class="fa-solid fa-pen-to-square me-2 text-info"></i>Edit Task</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{route('tasks.destroy',$task->id)}}" method="POST" onsubmit="return confirm('Delete this task?')" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-trash-can me-2"></i>Delete</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <h5 class="fw-bold mb-2">{{$task->title}}</h5>
                        <p class="text-muted small mb-3 text-truncate-2" style="height: 3rem; overflow: hidden;">
                            {{$task->description ?? 'No description provided'}}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <div class="small text-muted">
                                <i class="fa-regular fa-calendar me-1"></i>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('M d') }}
                            </div>
                            <span class="badge badge-priority 
                                @if($task->priority == 'high') bg-danger-subtle text-danger 
                                @elseif($task->priority == 'medium') bg-warning-subtle text-warning 
                                @else bg-info-subtle text-info @endif">
                                {{$task->priority}}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="glass-card p-5 d-inline-block">
                        <i class="fa-solid fa-clipboard-list fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No tasks found</h4>
                        <p class="text-muted mb-4">Try adjusting your filters or create a new task.</p>
                        <a href="{{route('tasks.create')}}" class="btn btn-create btn-premium">Create your first task</a>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        setTimeout(() => {
            const alert = document.querySelector('.alert');
            if (alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }
        }, 5000);
    </script>
</body>
</html>
