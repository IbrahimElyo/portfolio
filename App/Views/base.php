<!DOCTYPE html>
<html lang="<?= $_SESSION['lang'] == 'fr_FR' ? 'fr' : 'en' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/style.css">
    <script defer src="script.js"></script>
    <script src="https://kit.fontawesome.com/de5f823271.js" crossorigin="anonymous"></script>
    <title>
        <?= \App\Core\Translation::get('My portfolio 🎆') ?>
    </title>
</head>
<body>
    <canvas id="canvas"></canvas>
    <!-- Navigation -->
    <header>
        <nav class="navigation">
            <a class="nav-link" href="index.php?controller=home&action=index"><img src="../public/images/home.svg" alt="home-button"></a>
            <a class="nav-link" href="index.php?controller=presentation&action=displayPresentation">
                <?= \App\Core\Translation::get('About') ?>
            </a>
            <a class="nav-link" href="index.php?controller=project&action=displayProject">
                <?= \App\Core\Translation::get('Projects') ?>
            </a>
            <a class="nav-link" href="index.php?controller=contact&action=displayContact">
                <?= \App\Core\Translation::get('Contact') ?>
            </a>
            <a class="nav-link" href="../public/cv/cv-ibrahim-elyousfi-dev.pdf" target="_blank">
                <?= \App\Core\Translation::get('Resume') ?>
            </a>
            <a class="mode-button" href="#"><img src="../public/images/sun.svg" alt="sun-button"></a>
            <select name="language" id="language-selector" onchange="changeLanguage()">
                <option value="en_US" <?= $_SESSION['lang'] == 'en_US' ? 'selected' : '' ?>>🇬🇧 EN</option>
                <option value="fr_FR" <?= $_SESSION['lang'] == 'fr_FR' ? 'selected' : '' ?>>🇫🇷 FR</option>
            </select>
        </nav>
        <button class="menu-burger">
            <span class="line l1"></span>
            <span class="line l2"></span>
            <span class="line l3"></span>
        </button>
    </header>
    <!-- end Navigation -->
    <main>
        <?= $content ?>
    </main>
    <footer>
        <span>&copy; 2024 - <a class="auth-link" href="index.php?controller=auth&action=index" class="auth-link">Ibrahim El yousfi</a></span>
        <section class="section-center">
            <a href="mailto:ibrahimelyousfi26@gmail.com"><img src="../public/images/message.svg" alt="message"></a>
            <a href="https://github.com/IbrahimElyo" target="_blank"><img src="../public/images/github.svg" alt="message"></a>
            <a href="https://www.linkedin.com/in/ibrahim-elyousfi" target="_blank"><img src="../public/images/linkedin.svg" alt="message"></a>
        </section>
    </footer>
</body>
</html>
