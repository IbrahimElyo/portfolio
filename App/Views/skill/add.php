<?php
$title = "Add Skill"; 
?>

<h1>Add Skill</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $addForm;