<?php
$title = "Delete Skill";
?>

<div>
    <p>Do you want to remove the skill below?</p>
    <div>
        <strong>Skill name:</strong> <?php echo $skill->skill_name; ?><br>
        <strong>Skill description:</strong> <?php echo $skill->skill_description; ?><br>
        <strong>Icon:</strong> <?php echo $skill->icon; ?><br>
    </div>
    <form action="#" method="POST">
        <input type="submit" name="true" value="OUI"></input>
        <input type="submit" name="false" value="NON"></input>
    </form>
</div>
