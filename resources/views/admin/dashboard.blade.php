<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                        <a class="nav-link active" href="{{ route('admin.dashboard') }}">User Management</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.role.index') }}">Manage Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.permission.index') }}">Manage permission</a>
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

                <div class="card" id="user-management">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">User Management</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Telephone</th>
                                        <th>Address</th>
                                        <th>Current Role</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->telephone ?? 'N/A' }}</td>
                                        <td>{{ $user->address ?? 'N/A' }}</td>
                                        <td>
                                            <span class="badge {{ $user->role->name == 'admin' ? 'bg-danger' : 'bg-success' }}">
                                                {{ ucfirst($user->role->name) }}
                                            </span>
                                        </td>
                                        <td>
                                            <form action="{{ route('update.user.role', $user->id) }}" method="POST" class="d-flex">
                                                @csrf
                                                {{-- @method('PUT')
                                                <select name="role_id" class="form-select form-select-sm me-2" style="width: 100px;">
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                                            {{ ucfirst($role->name) }}
                                                        </option>
                                                    @endforeach
                                                </select> --}}
                                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
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