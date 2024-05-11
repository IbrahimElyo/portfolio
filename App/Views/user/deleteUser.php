<?php
$title = "Delete User";
?>

<div>
    <p>Do you want to remove the user below?</p>
    <div class=''>
        <strong>Username:</strong> <?php echo $user->username; ?><br>
        <strong>E-mail:</strong> <?php echo $user->email; ?><br>
        <strong>Profile info:</strong> <?php echo $user->profile_info; ?><br>
        <strong>Profile photo:</strong> <?php echo $user->profile_photo; ?><br>
    </div>
    <form action="#" method="POST">
        <input type="submit" name="true" value="OUI"></input>
        <input type="submit" name="false" value="NON"></input>
    </form>
</div>
