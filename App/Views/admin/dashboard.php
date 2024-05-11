<?php $title = "My Portfolio - Admin Session"; ?>
<div class="dashboard-container">
    <h1 class="dashboard-title">Dashboard</h1>
    <div>
        <table class="dashboard-table">
            <tr>
                <th>Home Page</th>
            <tr>
                <td><?php echo $aboutForm; ?></td>
            </tr>
            <tr>
                <th>About Page</th>
            <tr>
            <tr>
                <td><?php echo $skillsForm; ?></td>
            </tr>
            <tr>
                <th>Project Page</th>
            <tr>
            <tr>
                <td><?php echo $projectsForm; ?></td>
            </tr>
        </table>
    </div>
    <a href="index.php?controller=admin&action=deconnexion" class="logout-link">Logout</a>
</div>
