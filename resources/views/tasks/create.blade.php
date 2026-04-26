<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Task - TaskFlow</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            --accent-primary: #6366f1;
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
        .btn-submit { background-color: var(--accent-primary); color: white; border: none; }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4); color: white; }
        
        .form-label { font-weight: 600; color: #4b5563; margin-bottom: 0.5rem; }
        .form-control, .form-select {
            border-radius: 12px;
            padding: 0.75rem 1rem;
            border: 1px solid #e5e7eb;
            background: white;
        }
        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
            border-color: var(--accent-primary);
        }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="form-card">
            <h2 class="fw-bold mb-4 text-center">
                <i class="fa-solid fa-circle-plus text-primary me-2"></i>Create Task
            </h2>
            
            <form action="{{route('tasks.store')}}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-heading text-muted"></i></span>
                        <input type="text" name="title" class="form-control border-start-0 @error('title') is-invalid @enderror" 
                               id="title" placeholder="What needs to be done?" required value="{{old('title')}}">
                    </div>
                    @error('title') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description (Optional)</label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              id="description" rows="3" placeholder="Add more details...">{{old('description')}}</textarea>
                    @error('description') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="due_date" class="form-label">Due Date</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-regular fa-calendar text-muted"></i></span>
                            <input type="date" name="due_date" class="form-control border-start-0 @error('due_date') is-invalid @enderror" 
                                   id="due_date" required value="{{old('due_date')}}">
                        </div>
                        @error('due_date') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="priority" class="form-label">Priority</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-flag text-muted"></i></span>
                            <select name="priority" id="priority" class="form-select border-start-0 @error('priority') is-invalid @enderror">
                                <option value="low" @selected(old('priority') == 'low')>Low</option>
                                <option value="medium" @selected(old('priority', 'medium') == 'medium')>Medium</option>
                                <option value="high" @selected(old('priority') == 'high')>High</option>
                            </select>
                        </div>
                        @error('priority') <div class="invalid-feedback d-block mt-1 small">{{$message}}</div> @enderror
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-submit btn-premium">
                        <i class="fa-solid fa-check me-2"></i> Create Task
                    </button>
                    <a href="{{route('tasks.index')}}" class="btn btn-outline-secondary btn-premium">
                        <i class="fa-solid fa-xmark me-2"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
