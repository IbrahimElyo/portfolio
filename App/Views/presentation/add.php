<?php

$title = "Add Presentation"; ?>

<h1>Add Presentation</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $addForm;