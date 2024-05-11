<?php

$title = "Add User"; ?>

<h1>Add User</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $addForm;