<?php
$title = "Presentation";
?>

<h1>Presentation Page</h1>
<ul>
    <li><a href="index.php?controller=presentation&action=add">ADD PRESENTATION</a></li>
</ul>
<section>
    <table>
        <thead>
            <tr>
                <th>Full name</th>
                <th>About me</th>
                <th>Phone number</th>
                <th>E-mail</th>
                <th>Website url</th>
                <th>Address</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td><?=$value->full_name?></td>
                    <td><?=$value->about_me?></td>
                    <td><?=$value->phone_number?></td>
                    <td><?=$value->email?></td>
                    <td><?=$value->website_url?></td>
                    <td><?=$value->address?></td>
                    <td>
                        <a href="index.php?controller=presentation&action=updatePresentation&id=<?=$value->id?>">UPDATE</a>
                        <a href="index.php?controller=presentation&action=deletePresentation&id=<?=$value->id?>">DELETE</a>
                        <a href="index.php?controller=presentation&action=showPresentation&id=<?=$value->id?>">SHOW</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>