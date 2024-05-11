<?php
$title = "Delete Presentation";
?>

<div>
    <p>Do you want to delete the presentation below?</p>
    <div class=''>
        <strong>Full name:</strong> <?php echo $presentation->full_name; ?><br>
        <strong>About me:</strong> <?php echo $presentation->about_me; ?><br>
        <strong>Phone number:</strong> <?php echo $presentation->phone_number; ?><br>
        <strong>E-mail:</strong> <?php echo $presentation->email; ?><br>
        <strong>Website url:</strong> <?php echo $presentation->website_url; ?><br>
        <strong>Address:</strong> <?php echo $presentation->address; ?><br>
    </div>
    <form action="#" method="POST">
        <input type="submit" name="true" value="OUI"></input>
        <input type="submit" name="false" value="NON"></input>
    </form>
</div>
