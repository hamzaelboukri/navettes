<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Role Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
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
        .table-action-btn {
            display: inline-block;
            margin-right: 5px;
        }
        .role-card {
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .role-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header class="admin-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Admin Dashboard</h1>
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
                        <a class="nav-link active" href="{{ route('admin.role.index') }}">Role Management</a>
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

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0">Create New Role</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.role.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="roleName" class="form-label">Role Name</label>
                                        <input type="text" class="form-control" id="roleName" name="role_name" placeholder="Enter role name" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="roleDescription" class="form-label">Description</label>
                                        <textarea class="form-control" id="roleDescription" name="description" rows="3" placeholder="Enter role description"></textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Permissions</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="readPermission" name="permissions[]" value="read">
                                            <label class="form-check-label" for="readPermission">Read</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="writePermission" name="permissions[]" value="write">
                                            <label class="form-check-label" for="writePermission">Write</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="deletePermission" name="permissions[]" value="delete">
                                            <label class="form-check-label" for="deletePermission">Delete</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="adminPermission" name="permissions[]" value="admin">
                                            <label class="form-check-label" for="adminPermission">Admin</label>
                                        </div>
                                    </div>

                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Create Role</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                                <h4 class="mb-0">Role Management</h4>
                                <form action="{{ route('admin.role.search') }}" method="GET" class="d-flex" style="max-width: 300px;">
                                    <input type="text" class="form-control" placeholder="Search roles" name="search">
                                    <button class="btn btn-light ms-2" type="submit">
                                        Search
                                    </button>
                                </form>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($roles as $role)
                                    <div class="col-md-6 col-lg-4">
                                        <div class="card role-card">
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $role->name }}</h5>
                                                <p class="card-text">{{ $role->description ?? 'No description available' }}</p>
                                                <p class="card-text"><small class="text-muted">
                                                    Permissions: {{ implode(', ', $role->permissions) }}
                                                </small></p>
                                            </div>
                                            <div class="card-footer d-flex justify-content-between bg-white">
                                                <a href="{{ route('admin.role.edit', $role->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                                <form action="{{ route('admin.role.destroy', $role->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this role?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>