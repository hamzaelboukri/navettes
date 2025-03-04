<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcements</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .admin-header {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
        }
        .admin-sidebar {
            background-color: #f8f9fa;
            min-height: calc(100vh - 76px);
            padding-top: 20px;
        }
        .admin-content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Announcements</h1>
                <div>
                    <span class="me-3">Welcome, {{ Auth::user()->name }}</span>
                    <a href="{{ route('logout') }}" class="btn btn-outline-light btn-sm" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 admin-sidebar">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.dashboard') }}">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('user.announcements') }}">Announcements</a>
                    </li>
                </ul>
            </div>
            
            <div class="col-md-10 admin-content">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Create New Announcement</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.announcements.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Create Announcement</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Existing Announcements</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($announcements as $announcement)
                                    <tr>
                                        <td>{{ $announcement->id }}</td>
                                        <td>{{ $announcement->title }}</td>
                                        <td>{{ $announcement->content }}</td>
                                        <td>{{ $announcement->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <form action="{{ route('user.announcements.destroy', $announcement->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>