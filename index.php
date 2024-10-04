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
    <div x-data="{}">
        <header class="header">
            <h1>GuestBook</h1>
            <nav class="main-nav">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="php/guestbook.php">GuestBook</a></li>
                    <li><a href="php/contact.php">Contact</a></li>
                </ul>
            </nav>
            <nav class="auth-nav">
                <ul>
                    <li><a href="php/connexion.php" class="btn">Connexion</a></li>
                    <li><a href="php/inscription.php" class="btn">Inscription</a></li>
                </ul>
            </nav>
        </header>
    
        <main class="main-content">
            <section>
                <h2>Bienvenue sur notre livre d'or</h2>
                <p>Vous pouvez laisser un message sur notre livre d'or.</p>

                <a href="php/guestbook.php" class="btn">Accéder au GuestBook</a>
            </section>
        </main>
    
        <footer>
            <p>© 2024 GuestBook </p>
        </footer>
    </div>
</body>
</html>
