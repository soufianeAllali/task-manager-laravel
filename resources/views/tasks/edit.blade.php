<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --accent-info: #0ea5e9;
            --glass-bg: rgba(255, 255, 255, 0.85);
            --glass-border: rgba(255, 255, 255, 0.4);
        }
        body {
            background: var(--bg-gradient);
            background-attachment: fixed;
            min-height: 100vh;
            font-family: 'Plus Jakarta Sans', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem 0;
        }
        .form-card {
            background: var(--glass-bg);
            backdrop-filter: blur(12px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 3rem;
            width: 100%;
            max-width: 600px;
        }
        .btn-premium {
            border-radius: 12px;
            padding: 0.8rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-save { background-color: var(--accent-info); color: white; border: none; }
        .btn-save:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(14, 165, 233, 0.4); color: rgb(19, 190, 220); }
        
        .form-label { font-weight: 600; color: #4b5563; margin-bottom: 0.5rem; }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            background: white;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
            border-color: var(--accent-info);
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="form-card">
            <h2 class="fw-bold mb-4 text-center text-info">
                <i class="fa-solid fa-pen-to-square me-2"></i>Edit Task
            </h2>
            
            <form action="{{route('tasks.update',$task->id)}}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-title text-muted"></i></span>
                        <input type="text" name="title" class="form-control border-start-0 @error('title') is-invalid @enderror" 
                               id="title" placeholder="Task title" required value="{{old('title', $task->title)}}">
                    </div>
                    @error('title') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              id="description" rows="3" placeholder="Details about this task">{{old('description', $task->description)}}</textarea>
                    @error('description') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="due_date" class="form-label">Due Date</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-regular fa-calendar-check text-muted"></i></span>
                            <input type="date" name="due_date" class="form-control border-start-0 @error('due_date') is-invalid @enderror" 
                                   id="due_date" required value="{{old('due_date', $task->due_date)}}">
                        </div>
                        @error('due_date') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="priority" class="form-label">Priority</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-flag-checkered text-muted"></i></span>
                            <select name="priority" id="priority" class="form-select border-start-0 @error('priority') is-invalid @enderror">
                                <option value="low" @selected(old('priority', $task->priority) == 'low')>Low</option>
                                <option value="medium" @selected(old('priority', $task->priority) == 'medium')>Medium</option>
                                <option value="high" @selected(old('priority', $task->priority) == 'high')>High</option>
                            </select>
                        </div>
                        @error('priority') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-save btn-premium">
                        <i class="fa-solid fa-floppy-disk me-2"></i> Update Task
                    </button>
                    <a href="{{route('tasks.index')}}" class="btn btn-outline-secondary btn-premium">
                        <i class="fa-solid fa-arrow-left me-2"></i> Go Back
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
