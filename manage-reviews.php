<?php
$conn = mysqli_connect("localhost", "root", "", "movie-overview");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$result = mysqli_query($conn, "SELECT * FROM reviews ORDER BY created_at DESC");
?>

<h2>Manage Reviews</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Movie</th>
        <th>Author</th>
        <th>Review</th>
        <th>Date</th>
        <th>Action</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['movie']) ?></td>
            <td><?= htmlspecialchars($row['author']) ?></td>
            <td><?= htmlspecialchars($row['content']) ?></td>
            <td><?= $row['created_at'] ?></td>
            <td><a href="delete-review.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this review?')">Delete</a></td>
        </tr>
    <?php } ?>
</table>
