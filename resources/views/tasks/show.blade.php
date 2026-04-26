<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Details - {{$task->title}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-bg: #f8f9fa;
            --card-shadow: 0 10px 30px rgba(0,0,0,0.05);
            --accent-color: #6366f1;
        }
        body {
            background-color: var(--primary-bg);
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #1f2937;
        }
        .details-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 24px;
            box-shadow: var(--card-shadow);
            padding: 2.5rem;
            margin-top: 3rem;
            margin-bottom: 3rem;
        }
        .status-badge {
            padding: 0.6rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-pending { background-color: #fef3c7; color: #92400e; }
        .status-completed { background-color: #dcfce7; color: #166534; }
        
        .priority-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.8rem;
        }
        .priority-low { background-color: #e0f2fe; color: #075985; }
        .priority-medium { background-color: #fef3c7; color: #92400e; }
        .priority-high { background-color: #fee2e2; color: #991b1b; }

        .btn-premium {
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-edit { background-color: var(--accent-color); color: white; border: none; }
        .btn-edit:hover { background-color: #4f46e5; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4); color: white; }
        
        .info-label {
            color: #6b7280;
            font-size: 0.85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.4rem;
        }
        .info-value {
            font-size: 1.1rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="details-card">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h1 class="fw-bold mb-2">{{$task->title}}</h1>
                            <span class="status-badge {{$task->status == 'pending' ? 'status-pending' : 'status-completed'}}">
                                <i class="fa-solid {{$task->status == 'pending' ? 'fa-clock' : 'fa-check-circle'}} me-2"></i>
                                {{$task->status}}
                            </span>
                        </div>
                        <div class="priority-badge priority-{{$task->priority}}">
                            <i class="fa-solid fa-flag me-1"></i> {{ucfirst($task->priority)}} Priority
                        </div>
                    </div>

                    <hr class="my-4" style="opacity: 0.1;">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="info-label">Description</div>
                            <p class="info-value text-muted" style="line-height: 1.6;">
                                {{$task->description ?? 'No description provided.'}}
                            </p>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="info-label">Due Date</div>
                            <div class="info-value">
                                <i class="fa-regular fa-calendar-days me-2 text-primary"></i>
                                {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-label">Created At</div>
                            <div class="info-value">
                                <i class="fa-regular fa-clock me-2 text-secondary"></i>
                                {{$task->created_at->format('M d, Y')}}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mt-4 pt-4 border-top">
                        <a href="{{route('tasks.index')}}" class="btn btn-outline-secondary btn-premium">
                            <i class="fa-solid fa-arrow-left me-2"></i> Back to List
                        </a>
                        <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-edit btn-premium">
                            <i class="fa-solid fa-pen-to-square me-2"></i> Edit Task
                        </a>
                        <form action="{{route('tasks.destroy',$task->id)}}" method="POST" onsubmit="return confirm('Delete this task?')" class="ms-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-premium">
                                <i class="fa-solid fa-trash-can me-2"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
