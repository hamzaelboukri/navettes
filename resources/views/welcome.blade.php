<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NavetteConnect - Gestion des Navettes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(13, 110, 253, 0.8), rgba(13, 110, 253, 0.9)), url('https://via.placeholder.com/1920x1080');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .feature-icon {
            font-size: 3rem;
            color: #0d6efd;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-bus me-2"></i>NavetteConnect
            </a>
            <div class="ms-auto">
                <a href="{{ route('login.show') }}" class="btn btn-outline-light me-2">Connexion</a>
                <a href="{{ route('register.show') }}" class="btn btn-light">Inscription</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Simplifiez vos déplacements quotidiens</h1>
            <p class="lead mb-5">NavetteConnect est une plateforme qui connecte les sociétés de transport et les voyageurs pour des abonnements de navettes simples et efficaces.</p>
            <div>
                <a href="{{ route('register.show') }}" class="btn btn-light btn-lg me-2">S'inscrire</a>
                <a href="#" class="btn btn-outline-light btn-lg">En savoir plus</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Ce que NavetteConnect peut faire pour vous</h2>
            <div class="row g-4">
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <h4>Pour les voyageurs</h4>
                    <p>Trouvez et abonnez-vous à des navettes régulières entre villes. Soumettez des demandes pour de nouveaux trajets et horaires selon vos besoins.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-bus-alt"></i>
                    </div>
                    <h4>Pour les sociétés de transport</h4>
                    <p>Gérez vos offres de navettes, visualisez la demande des utilisateurs et optimisez vos trajets pour maximiser votre rentabilité.</p>
                </div>
                <div class="col-md-4 text-center">
                    <div class="feature-icon">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <h4>Connexion intelligente</h4>
                    <p>Notre plateforme met en relation l'offre et la demande pour créer un système de transport plus efficace et adapté aux besoins réels.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-primary text-white py-5">
        <div class="container text-center">
            <h2 class="mb-4">Prêt à commencer ?</h2>
            <p class="lead mb-4">Rejoignez NavetteConnect dès aujourd'hui et transformez votre expérience de transport quotidien.</p>
            <a href="{{ route('login.show') }}" class="btn btn-light btn-lg me-2">Connexion</a>
            <a href="{{ route('register.show') }}" class="btn btn-outline-light btn-lg">Inscription</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; 2025 NavetteConnect - Tous droits réservés</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
