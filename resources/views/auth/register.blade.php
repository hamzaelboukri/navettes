<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion & Inscription</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Animation CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="container-fluid">
        <div class="row auth-container">
            <!-- Left side with welcome message -->
            <div class="col-md-6 left-side animate__animated animate__fadeIn">
                <div class="h-100 d-flex flex-column justify-content-center">
                    <h1 class="display-4 mb-4">Bienvenue!</h1>
                    <p class="lead">Inscrivez-vous pour accéder à notre plateforme et profiter de tous nos services.</p>
                    <div class="mt-5">
                        <p>Vous avez déjà un compte?</p>
                        <a href="{{ route('login.show') }}" class="btn btn-outline-light">Se connecter</a>
                    </div>
                </div>
            </div>
            
            <!-- Right side with form -->
            <div class="col-md-6 form-side animate__animated animate__fadeInRight">
                <h2 class="mb-4">Inscription</h2>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="signupName" class="form-label">Nom complet</label>
                        <input type="text" class="form-control" id="signupName" name="name" placeholder="Entrez votre nom">
                    </div>
                    <div class="mb-3">
                        <label for="signupEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="signupEmail" name="email" placeholder="Entrez votre email">
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">Telephone</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" placeholder="Telephone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Adresse">
                    </div>
                    <div class="mb-3">
                        <label for="signupPassword" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control" id="signupPassword" name="password" placeholder="Créez un mot de passe">
                    </div>
                    <div class="mb-3">
                        <label for="signupPasswordConfirmation" class="form-label">Confirmez le mot de passe</label>
                        <input type="password" class="form-control" id="signupPasswordConfirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe">
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Choisissez votre rôle</label>
                        <input type="hidden" id="role" name="role" value="client">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="role-card client d-flex flex-column align-items-center justify-content-center animate__animated animate__fadeIn" data-role="client" onclick="selectRole(this, 'client')">
                                    <div class="role-check">✓</div>
                                    <div class="role-icon">👤</div>
                                    <div class="role-title">Client</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="role-card soigneur d-flex flex-column align-items-center justify-content-center animate__animated animate__fadeIn" data-role="soigneur" onclick="selectRole(this, 'soigneur')">
                                    <div class="role-check">✓</div>
                                    <div class="role-icon">⚕️</div>
                                    <div class="role-title">Soigneur</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Optional fields for Soigneur only -->
                    <div id="soigneurFields" style="display: none;">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description de la société</label>
                            <textarea class="form-control" id="description" name="description" placeholder="Description de votre société"></textarea>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 animate__animated animate__pulse">S'inscrire</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Set default role
        document.addEventListener('DOMContentLoaded', function() {
            // Default to client role
            const defaultRoleCard = document.querySelector('.role-card[data-role="client"]');
            if (defaultRoleCard) {
                selectRole(defaultRoleCard, 'client');
            }
        });

        function selectRole(element, role) {
            console.log('Selecting role:', role);
            
            // Remove selected class from all cards
            document.querySelectorAll('.role-card').forEach(card => {
                card.classList.remove('selected');
                card.classList.remove('animate__pulse');
            });
            
            // Add selected class to clicked card
            element.classList.add('selected');
            element.classList.add('animate__animated');
            element.classList.add('animate__pulse');
            
            // Set the hidden input value
            document.getElementById('role').value = role;
            
            // Show/hide soigneur-specific fields
            if (role === 'soigneur') {
                document.getElementById('soigneurFields').style.display = 'block';
            } else {
                document.getElementById('soigneurFields').style.display = 'none';
            }
            
            console.log('Role value set to:', document.getElementById('role').value);
        }

        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.classList.add('animate__animated', 'animate__pulse');
            });
            
            input.addEventListener('blur', function() {
                this.classList.remove('animate__animated', 'animate__pulse');
            });
        });
    </script>
</body>
</html>