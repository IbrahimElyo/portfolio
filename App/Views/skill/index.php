<?php 
$title = "Skills";
?>
<h1>Skills Page</h1>
<ul>
    <li><a href="index.php?controller=skill&action=add">ADD SKILL</a></li>
</ul>
<section>
    <table>
        <thead>
            <tr>
                <th>Skill name</th>
                <th>Skill description</th>
                <th>Skill icon</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td><?=$value->skill_name?></td>
                    <td><?=$value->skill_description?></td>
                    <td><?=$value->skill_icon?></td>
                    <td>
                <a href="index.php?controller=skill&action=updateSkill&id=<?=$value->id?>">UPDATE</a>
                <a href="index.php?controller=skill&action=deleteSkill&id=<?=$value->id?>">DELETE</a>
                <a href="index.php?controller=skill&action=showSkill&id=<?=$value->id?>">SHOW</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
