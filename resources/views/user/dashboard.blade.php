<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        .user-header {
            background-color: #0d6efd;
            color: white;
            padding: 20px 0;
        }
        .dashboard-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <header class="user-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1>Welcome to Your Dashboard</h1>
                <div>
                    <span class="me-3">Hello, {{ Auth::user()->name }}</span>
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

    <div class="container py-5">
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
            <div class="col-md-4">
                <div class="card dashboard-card animate__animated animate__fadeIn">
                    <div class="card-body text-center">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: #0d6efd;"></i>
                        <h3 class="mt-3">Your Profile</h3>
                        <p>View and update your personal information</p>
                        <a href="#" class="btn btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card dashboard-card animate__animated animate__fadeIn" style="animation-delay: 0.2s">
                    <div class="card-body text-center">
                        <i class="bi bi-calendar-check" style="font-size: 3rem; color: #198754;"></i>
                        <h3 class="mt-3">Appointments</h3>
                        <p>Manage your upcoming appointments</p>
                        <a href="#" class="btn btn-success">View Appointments</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card dashboard-card animate__animated animate__fadeIn" style="animation-delay: 0.4s">
                    <div class="card-body text-center">
                        <i class="bi bi-chat-dots" style="font-size: 3rem; color: #6610f2;"></i>
                        <h3 class="mt-3">Messages</h3>
                        <p>Check your messages and notifications</p>
                        <a href="#" class="btn btn-primary">View Messages</a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Your Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Name:</strong> {{ Auth::user()->name }}</p>
                                <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Telephone:</strong> {{ Auth::user()->telephone ?? 'Not provided' }}</p>
                                <p><strong>Address:</strong> {{ Auth::user()->address ?? 'Not provided' }}</p>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <a href="#" class="btn btn-outline-primary">Update Information</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Optional animations for a more dynamic dashboard
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate__fadeInUp');
                }, index * 200);
            });
        });
    </script>
</body>
</html>