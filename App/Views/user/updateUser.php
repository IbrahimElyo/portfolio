<?php
$title = "Update User";
?>

<h1>Update User</h1>
<?php
if(!empty($erreur)){
    echo $erreur;
}

echo $updateForm;