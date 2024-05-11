<?php
$title = "Delete Hobby";
?>

<div>
    <p>Do you want to remove the hobby below?</p>
    <div class=''>
        <strong>Hobby name:</strong> <?php echo $hobby->hobby_name; ?><br>
        <strong>Description:</strong> <?php echo $hobby->description; ?><br>
        <strong>Icon:</strong> <?php echo $hobby->icon; ?><br>
    </div>
    <form action="#" method="POST">
        <input type="submit" name="true" value="OUI"></input>
        <input type="submit" name="false" value="NON"></input>
    </form>
</div>
