<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center w-100">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight m-0">
                <i class="fa-solid fa-chart-line text-primary me-2"></i>{{ __('Statistics Overview') }}
            </h2>
            <a href="{{ route('tasks.index') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                <i class="fa-solid fa-list-check me-2"></i>View My Tasks
            </a>
        </div>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        .dashboard-body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .stat-card {
            background: white;
            border-radius: 20px;
            padding: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            transition: all 0.3s ease;
            height: 100%;
        }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .stat-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin-bottom: 1rem;
        }
        .icon-blue { background: #eff6ff; color: #3b82f6; }
        .icon-yellow { background: #fffbeb; color: #f59e0b; }
        .icon-green { background: #f0fdf4; color: #10b981; }
        .icon-red { background: #fef2f2; color: #ef4444; }
        
        .today-task-item {
            padding: 1rem;
            border-radius: 12px;
            background: #f8fafc;
            margin-bottom: 0.75rem;
            border-left: 4px solid #6366f1;
            transition: background 0.2s ease;
        }
        .today-task-item:hover { background: #f1f5f9; }
    </style>

    <div class="py-12 dashboard-body">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row g-4 mb-5">
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon icon-blue"><i class="fa-solid fa-list-ul"></i></div>
                        <h6 class="text-muted small fw-bold text-uppercase ls-1">Total Tasks</h6>
                        <h2 class="fw-bold m-0">{{ $total_tasks }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon icon-yellow"><i class="fa-solid fa-spinner"></i></div>
                        <h6 class="text-muted small fw-bold text-uppercase ls-1">Pending</h6>
                        <h2 class="fw-bold m-0">{{ $pending_tasks }}</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card">
                        <div class="stat-icon icon-green"><i class="fa-solid fa-circle-check"></i></div>
                        <h6 class="text-muted small fw-bold text-uppercase ls-1">Completed</h6>
                        <h2 class="fw-bold m-0">{{ $completed_tasks }}</h2>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="stat-card">
                        <h5 class="fw-bold mb-4"><i class="fa-regular fa-calendar-days text-primary me-2"></i>Tasks for Today</h5>
                        <div class="today-tasks-list">
                            @forelse($today_tasks as $task)
                                <div class="today-task-item d-flex justify-content-between align-items-center">
                                    <span class="fw-medium">{{ $task->title }}</span>
                                    <span class="badge bg-white text-dark border rounded-pill">{{ \Carbon\Carbon::parse($task->due_date)->format('H:i') }}</span>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <img src="https://illustrations.popsy.co/gray/success.svg" alt="No tasks" style="width: 120px;" class="mb-3">
                                    <p class="text-muted m-0">You're all caught up! No tasks for today.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="stat-card">
                        <h5 class="fw-bold mb-4"><i class="fa-solid fa-fire text-danger me-2"></i>Priority Pulse</h5>
                        <div class="d-flex flex-column gap-3">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small fw-semibold text-danger">High Priority</span>
                                <span class="badge rounded-pill bg-danger">{{ $high_priority_tasks }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-danger" style="width: {{ $total_tasks > 0 ? ($high_priority_tasks/$total_tasks)*100 : 0 }}%"></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small fw-semibold text-warning">Medium Priority</span>
                                <span class="badge rounded-pill bg-warning text-dark">{{ $medium_priority_tasks }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: {{ $total_tasks > 0 ? ($medium_priority_tasks/$total_tasks)*100 : 0 }}%"></div>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="small fw-semibold text-info">Low Priority</span>
                                <span class="badge rounded-pill bg-info">{{ $low_priority_tasks }}</span>
                            </div>
                            <div class="progress" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: {{ $total_tasks > 0 ? ($low_priority_tasks/$total_tasks)*100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
