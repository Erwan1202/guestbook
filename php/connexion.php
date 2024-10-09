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
    include '../php/db_connect.php'; // Inclure le fichier de connexion à la base de données

    $error_message = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = htmlspecialchars($_POST['username']);
        $password = htmlspecialchars($_POST['password']);

        // Requête pour vérifier l'utilisateur dans la base de données
        $sql = "SELECT password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            // Si l'utilisateur existe, on récupère le mot de passe haché
            $stmt->bind_result($hashed_password);
            $stmt->fetch();

            // Vérifier le mot de passe
            if (password_verify($password, $hashed_password)) {
                $_SESSION['username'] = $username;
                header('Location: ../php/guestbook.php');
                exit;
            } else {
                $error_message = 'Nom d’utilisateur ou mot de passe incorrect.';
            }
        } else {
            $error_message = 'Nom d’utilisateur ou mot de passe incorrect.';
        }

        $stmt->close();
    }

    $conn->close(); // Fermer la connexion
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

