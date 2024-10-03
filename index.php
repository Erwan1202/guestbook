<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GuestBook</title>
    <meta charset="utf-8">
    <meta name="description" content="GuestBook">
    <meta name="keywords" content="GuestBook">
    <meta name="author" content="Erwan Marechal">
    <meta name="viewport" content="width=device-width, initial-scale=1"> <!--Responsive-->
    <link rel="stylesheet" type="text/css" href="css/style.css"> <!--CSS externe-->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/persist@3.x.x/dist/cdn.min.js"></script> <!--AlpineJS $persist-->
    <script src="//unpkg.com/alpinejs" defer></script> <!--AlpineJS-->
</head>

<body>
    <div x-data="{ log: $persist(false) }">
        <header class="header">
            <h1>GuestBook</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <template x-if="log">
                        <!-- Le lien vers le GuestBook est disponible uniquement si l'utilisateur est connecté -->
                        <li><a href="guestbook.php">GuestBook</a></li>
                    </template>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
            <nav class="auth-nav">
                <ul>
                    <!-- Affiche les boutons de Connexion/Inscription seulement si l'utilisateur n'est pas connecté -->
                    <template x-if="!log">
                        <li><button><a href="connexion.php">Connexion</a></button></li>
                    </template>
                    <template x-if="!log">
                        <li><button><a href="inscription.php">Inscription</a></button></li>
                    </template>

                    <!-- Si l'utilisateur est connecté, afficher un bouton Déconnexion -->
                    <template x-if="log">
                        <li><button @click="log = false">Déconnexion</button></li>
                    </template>
                </ul>
            </nav>
        </header>
    
        <main class="main-content">
            <section>
                <h2>Bienvenue sur notre livre d'or</h2>
                <p>Vous pouvez laisser un message sur notre livre d'or.</p>

                <!-- Si l'utilisateur est connecté, afficher le bouton pour accéder au GuestBook -->
                <template x-if="log">
                    <button><a href="guestbook.php">Accéder au GuestBook</a></button>
                </template>

                <!-- Si l'utilisateur n'est pas connecté, proposer de se connecter pour accéder au GuestBook -->
                <template x-if="!log">
                    <p>Veuillez <a href="connexion.php">vous connecter</a> pour accéder au GuestBook.</p>
                </template>
            </section>
        </main>
    
        <footer>
            <p>© 2024 GuestBook - Tous droits réservés.</p>
        </footer>
    </div>
</body>
</html>
