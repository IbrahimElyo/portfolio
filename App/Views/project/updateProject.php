<?php
$title = "Update Project";
?>

<h1>Update Project</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $updateForm;