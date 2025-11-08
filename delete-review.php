<?php
$conn = mysqli_connect("localhost", "root", "", "movie-overview");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    mysqli_query($conn, "DELETE FROM reviews WHERE id = $id");
}

header("Location: manage-reviews.php");
exit;
?>
