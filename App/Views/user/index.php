<?php 
$title = "Users";
?>
<h1>Users Page</h1>
<ul>
    <li><a href="index.php?controller=user&action=add">ADD USER</a></li>
</ul>
<section>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>E-mail</th>
                <th>Profile info</th>
                <th>Profile photo</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td><?=$value->username?></td>
                    <td><?=$value->email?></td>
                    <td><?=$value->profile_info?></td>
                    <td><?=$value->profile_photo?></td>
                    <td>
                        <a href="index.php?controller=user&action=updateUser&id=<?=$value->id?>">UPDATE</a>
                        <a href="index.php?controller=user&action=deleteUser&id=<?=$value->id?>">DELETE</a>
                        <a href="index.php?controller=user&action=showUser&id=<?=$value->id?>">SHOW</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
