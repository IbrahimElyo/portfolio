<?php 
$title = "Experiences";
?>
<h1>Hobbies Page</h1>
<ul>
    <li><a href="index.php?controller=hobby&action=add">ADD HOBBY</a></li>
</ul>
<section>
    <table>
        <thead>
            <tr>
                <th>Hobby name</th>
                <th>Description</th>
                <th>Icon</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td><?=$value->hobby_name?></td>
                    <td><?=$value->description?></td>
                    <td><?=$value->icon?></td>
                    <td>
                        <a href="index.php?controller=hobby&action=updateHobby&id=<?=$value->id?>">UPDATE</a>
                        <a href="index.php?controller=hobby&action=deleteHobby&id=<?=$value->id?>">DELETE</a>
                        <a href="index.php?controller=hobby&action=showHobby&id=<?=$value->id?>">SHOW</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
