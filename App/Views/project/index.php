<?php 
$title = "Projects";
?>
<h1>Projects Page</h1>
<ul>
    <li><a href="index.php?controller=project&action=add">ADD PROJECT</a></li>
</ul>
<section>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Project link</th>
                <th>Project image</th>
                <th>Creation date</th>
                <th>Modification</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($list as $value) { ?>
                <tr>
                    <td><?=$value->title?></td>
                    <td><?=$value->description?></td>
                    <td><?=$value->project_link?></td>
                    <td><?=$value->project_image?></td>
                    <td><?=$value->creation_date?></td>
                    <td>
                        <a href="index.php?controller=project&action=updateProject&id=<?=$value->id?>">UPDATE</a>
                        <a href="index.php?controller=project&action=deleteProject&id=<?=$value->id?>">DELETE</a>
                        <a href="index.php?controller=project&action=showProject&id=<?=$value->id?>">SHOW</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</section>
