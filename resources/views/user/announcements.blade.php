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

                <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createAnnouncementModal">
                    Create New Announcement
                </button>

                <!-- The Modal -->
                <div class="modal" id="createAnnouncementModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Create New Announcement</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal Body -->
                            <div class="modal-body">
                                <form action="{{ route('user.announcements.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="societe_id" class="form-label">Société ID</label>
                                        <input type="number" class="form-control" id="societe_id" name="societe_id" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_debut" class="form-label">Date Début</label>
                                        <input type="date" class="form-control" id="date_debut" name="date_debut" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="date_arriver" class="form-label">Date Arriver</label>
                                        <input type="date" class="form-control" id="date_arriver" name="date_arriver" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="heure_debut" class="form-label">Heure Début</label>
                                        <input type="time" class="form-control" id="heure_debut" name="heure_debut" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="heure_arriver" class="form-label">Heure Arriver</label>
                                        <input type="time" class="form-control" id="heure_arriver" name="heure_arriver" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="destination" class="form-label">Destination</label>
                                        <input type="text" class="form-control" id="destination" name="destination" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="form-select" id="status" name="status" required>
                                            <option value="active">Active</option>
                                            <option value="inactive">Inactive</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="nb_place" class="form-label">Nombre de Places</label>
                                        <input type="number" class="form-control" id="nb_place" name="nb_place" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Create Announcement</button>
                                </form>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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