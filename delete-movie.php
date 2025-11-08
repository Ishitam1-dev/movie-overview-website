<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include '../backend/database.php'; // Connect to database

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Delete query
    $sql = "DELETE FROM movies WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        // Redirect back to manage page
        header("Location: manage-movie.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting movie: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request.";
}
?>
