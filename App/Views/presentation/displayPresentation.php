<?php 
use App\Core\Translation;
?>
<?php $title = "El yousfi Ibrahim"; ?>
<div class="about-block">
    <div class="readme-block">
        <h2 class="heading-2">Readme.md</h2>
        <p class="readme-text">👋<?=Translation::get($presentation[0]->readme)?></p>
    </div>
    <div class="skills-block">
        <h2 class="heading-2"><?=Translation::get("Skills");?></h2>
        <div class="skills-content">
            <?php
                foreach($skill as $value){
                    echo "<img src='$value->skill_url'></img>";
                }
            ?>
        </div>
    </div>
    <div class="interests-block">
        <h2 class="heading-2"><?=Translation::get("Interests");?></h2>
        <div class="interests-content">
            <?php
                $cpt = 1;
                foreach($hobby as $value){
                    ?>
                    <section class="interest interest-<?=$cpt;?>">
                        <span><?=Translation::get($value->hobby_name)?></span>
                        <?="<img src='".$value->icon."'</img>"?>
                    </section>
                    <?php
                        $cpt++;
                }
            ?>
        </div>
    </div>
</div>

