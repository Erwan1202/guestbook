<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Inscription</title>
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
    $success_message = '';

    // Simulation de stockage des utilisateurs (à remplacer par une base de données dans un projet réel)
    $users = [
        'user1' => 'password1',
        'user2' => 'password2'
    ];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);

        // Validation côté serveur
        if ($password !== $confirm_password) {
            $error_message = 'Les mots de passe ne correspondent pas.';
        } elseif (isset($users[$username])) {
            $error_message = 'Ce nom d’utilisateur est déjà pris.';
        } else {
            // Enregistrement (simulation ici, à stocker dans une base de données)
            $users[$username] = $password;
            $_SESSION['username'] = $username;
            $success_message = 'Inscription réussie ! Vous êtes connecté.';
            header('Location: ../php/guestbook.php');
            exit;
        }
    }
    ?>

    <div x-data="registerForm()" class="register-container">
        <h2>Inscription</h2>

        <!-- Affichage du message de succès ou d'erreur -->
        <p x-show="serverError" class="error-message" x-text="serverError"></p>
        <p x-show="serverSuccess" class="success-message" x-text="serverSuccess"></p>

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

            <div class="form-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" x-model="confirmPassword" @input="validateConfirmPassword" required>
                <p x-show="errors.confirmPassword" class="error-message" x-text="errors.confirmPassword"></p>
            </div>

            <button type="submit" :disabled="!isFormValid">S'inscrire</button>
        </form>

        <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </div>

    <script>
        function registerForm() {
            return {
                username: '',
                password: '',
                confirmPassword: '',
                errors: {
                    username: '',
                    password: '',
                    confirmPassword: ''
                },
                serverError: '<?php echo $error_message; ?>',
                serverSuccess: '<?php echo $success_message; ?>',
                isFormValid: false,

                validateUsername() {
                    this.errors.username = this.username.length < 3 ? "Le nom d'utilisateur doit contenir au moins 3 caractères." : "";
                    this.checkFormValidity();
                },

                validatePassword() {
                    this.errors.password = this.password.length < 6 ? "Le mot de passe doit contenir au moins 6 caractères." : "";
                    this.checkFormValidity();
                },

                validateConfirmPassword() {
                    this.errors.confirmPassword = this.password !== this.confirmPassword ? "Les mots de passe ne correspondent pas." : "";
                    this.checkFormValidity();
                },

                checkFormValidity() {
                    this.isFormValid = this.username.length >= 3 && this.password.length >= 6 && this.password === this.confirmPassword && !this.errors.username && !this.errors.password && !this.errors.confirmPassword;
                },

                submitForm() {
                    if (this.isFormValid) {
                        $el.closest('form').submit();
                    }
                }
            };
        }
    </script>
</body>
</html>
