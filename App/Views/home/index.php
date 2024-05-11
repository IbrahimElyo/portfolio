<?php
$title = "My Portfolio";
use App\Core\Translation;
?>


<div class="home-block">
    <h1 class="main-heading"><?= $elementPresentation[0]->full_name ?></h1>
    <h2 class="heading-2"><?= Translation::get($elementPresentation[0]->about_me . " 👨🏻‍💻") ?></h2>
    <h3><a href="index.php?controller=presentation&action=displayPresentation"><?= \App\Core\Translation::get("About me 👉") ?></a></h3>
</div>