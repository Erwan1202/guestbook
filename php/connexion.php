<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Connexion</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script>
    <script defer src="//unpkg.com/alpinejs"></script>
</head>
<body>
    <?php
    session_start();

    $error_message = '';

    // Simulation d'une base de données utilisateurs (utiliser une vraie base dans un projet réel)
    $users = [
        'user1' => 'password1',
        'user2' => 'password2'
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Vérification des informations de connexion
        if (isset($users[$username]) && $users[$username] === $password) {
            $_SESSION['username'] = $username;
            header('Location: ../php/guestbook.php');
            exit;
        } else {
            $error_message = 'Nom d’utilisateur ou mot de passe incorrect.';
        }
    }
    ?>

    <div x-data="loginForm()" class="login-container">
        <h2>Connexion</h2>

        <!-- Formulaire de connexion -->
        <form method="POST" @submit.prevent="submitForm">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" x-model="username" @input="validateUsername" required>
                <p x-show="errors.username" class="error-message" x-text="errors.username"></p>
            </div>

            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" x-model="password" @input="validatePassword" required>
                <p x-show="errors.password" class="error-message" x-text="errors.password"></p>
            </div>

            <p class="error-message" x-text="serverError"></p>
            
            <button type="submit" :disabled="!isFormValid">Se connecter</button>
        </form>

        <p>Vous n'avez pas de compte ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
    </div>

    <script>
        function loginForm() {
            return {
                username: '',
                password: '',
                errors: {
                    username: '',
                    password: ''
                },
                serverError: '<?php echo $error_message; ?>',
                isFormValid: false,

                validateUsername() {
                    this.errors.username = this.username.length < 3 ? "Le nom d'utilisateur doit contenir au moins 3 caractères." : "";
                    this.checkFormValidity();
                },

                validatePassword() {
                    this.errors.password = this.password.length < 6 ? "Le mot de passe doit contenir au moins 6 caractères." : "";
                    this.checkFormValidity();
                },

                checkFormValidity() {
                    this.isFormValid = this.username.length >= 3 && this.password.length >= 6 && !this.errors.username && !this.errors.password;
                },

                submitForm() {
                    // Si tout est bon côté Alpine.js, on soumet le formulaire
                    if (this.isFormValid) {
                        $el.closest('form').submit();
                    }
                }
            };
        }
    </script>
</body>
</html>
