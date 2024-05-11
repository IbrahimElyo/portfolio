<?php
$title = "Delete Project";
?>

<div>
    <p>Do you want to remove the project below?</p>
    <div class=''>
        <strong>Title:</strong> <?php echo $project->title; ?><br>
        <strong>Description:</strong> <?php echo $project->description; ?><br>
        <strong>Project link:</strong> <?php echo $project->project_link; ?><br>
        <strong>Project image:</strong> <?php echo $project->project_image; ?><br>
        <strong>Creation date:</strong> <?php echo $project->creation_date; ?><br>
    </div>
    <form action="#" method="POST">
        <input type="submit" name="true" value="OUI"></input>
        <input type="submit" name="false" value="NON"></input>
    </form>
</div>
