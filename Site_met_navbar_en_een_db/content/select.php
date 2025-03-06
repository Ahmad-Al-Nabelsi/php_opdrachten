<?php
include_once 'core/db_connect.php';

global $conn;
$result = $conn->query("SELECT * FROM user_empl");
?>

<h2>Employee List</h2>
<p>Some List of content-records.</p>
<a href="index.php?action=add" class="add-link">Add Employee</a>
<hr>

<ul>
    <?php while ($row = $result->fetch_assoc()): ?>
        <li>
            - Name: <?= $row['Voornaam'] . ' ' . $row['Achternaam'] ?>
            <a href="index.php?action=show&id=<?= $row['id'] ?>" class="show-link">Show</a>
            <a href="index.php?action=edit&id=<?= $row['id'] ?>" class="edit-link">Edit</a>
            <a href="index.php?action=delete&id=<?= $row['id'] ?>" class="delete-link" 
            onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a> <!--onclick is een 
            gebeurtenis in JavaScript die wordt gebruikt om bepaalde code uit te voeren wanneer op een element 
            wordt geklikt. -->
    <?php endwhile; ?>
</ul>
