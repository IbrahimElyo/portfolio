<?php

use App\Core\Translation;
?>

<div class="projects">
    <section class="projects-block">
        <p class="animated-border"><?= Translation::get($project[0]->description) ?></p>
        <section class="project-bottom-text">
            <h2><?= Translation::get("Here, an illustration of the website") ?></h2>
            <img src="<?= $project[0]->project_image; ?>" alt="website illustration"></img>
        </section>
        <section class="project-aside-text">
            <p class="animated-border"><?= Translation::get($project[1]->description) ?></p>
            <h2><?= Translation::get("Here's an example demonstrating an update process within the back office") ?></h2>
            <img src="<?= $project[1]->project_image; ?>" alt="backoffice illustration">
        </section>
        <section class="project-aside-text">
            <p><?= Translation::get("Additionally, I created this site with ") ?><img src="../public/images/wordpress.svg" alt="wordpress icon" title="Wordpress"><?= Translation::get(" and then compared the carbon footprint of the two sites.") ?></p>
            <div class="cube">
                <p><?= Translation::get("Here are the study results") ?><a href="https://www.clerc-et-net.com/code-et-carbone.pdf" target="_blank"><img src='../public/images/linkedin.svg'></img></a></p>
                <p><?= Translation::get("For more details, here is the source code of the website.") ?><a href="https://github.com/IbrahimElyo/artistwebsite.git" target="_blank"><img src='../public/images/github.svg'></a></p>
            </div>
        </section>
        <section class="project-bottom-text">
            <h2><?= Translation::get("Bonus") ?></h2>
            <p><?= Translation::get("I developed my portfolio using the MVC model, allowing for clear separation of concerns. Additionally, I implemented an admin area where I can dynamically update the portfolio content.") ?></p>
            <img src="../public/images/connexion-form.png" alt="form connexion" id="last-image">
            <h2><?= Translation::get("Here's an illustration of the dashboard") ?></h2>
            <img src="../public/images/dashboard-example.png" alt="dashboard example">
            <p><?= Translation::get("For more details, <a href='https://github.com/IbrahimElyo/portfolio.git' target='_blank'><strong>here</strong></a> is the source code of the website.") ?></p>
        </section>
    </section>
</div>