<?php

$title = "Add Hobby"; ?>

<h1>Add Hobby</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $addForm;