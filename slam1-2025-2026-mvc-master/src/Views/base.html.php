<?php
// Déclaration des variables
/** @var $content string */
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon site internet</title>
</head>
<body>

<header>
    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/about">A propos</a></li>
            <li><a href="#">Contact</a></li>
        </ul>
    </nav>
</header>

<main>
    <?= $content; ?>
</main>

</body>
</html>