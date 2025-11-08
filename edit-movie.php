<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

include '../backend/database.php';

// If movie ID not provided, redirect
if (!isset($_GET['id'])) {
    echo "Movie ID not provided.";
    exit;
}

$id = intval($_GET['id']); // always sanitize ID

// Fetch existing movie data
$sql = "SELECT * FROM movies WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows != 1) {
    echo "Movie not found.";
    exit;
}

$movie = $result->fetch_assoc();

// Update on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title        = $_POST['title'];
    $genre        = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $cast         = $_POST['cast'];
    $description  = $_POST['description'];

    // Image optional update
    if (!empty($_FILES['image']['name'])) {
        $image = $_FILES['image']['name'];
        $target = "../image/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $movie['image']; // keep old image
    }

    // Use prepared statement for update
    $update = "UPDATE movies 
               SET title=?, genre=?, release_date=?, `cast`=?, description=?, image=? 
               WHERE id=?";
    $stmt = $conn->prepare($update);
    $stmt->bind_param("ssssssi", $title, $genre, $release_date, $cast, $description, $image, $id);

    if ($stmt->execute()) {
        header("Location: manage-movie.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Movie</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body {
            background: #121212;
            color: #fff;
            font-family: Arial, sans-serif;
        }

        .form-container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            background: #1e1e1e;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(255,255,255,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-container label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        .form-container input[type="text"],
        .form-container input[type="date"],
        .form-container input[type="number"],
        .form-container textarea,
        .form-container input[type="file"] {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
            background: #2b2b2b;
            color: #fff;
            border: 1px solid #444;
            border-radius: 5px;
        }

        .form-container button {
            margin-top: 20px;
            padding: 10px 20px;
            background: #00b894;
            border: none;
            color: #fff;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-container button:hover {
            background: #019875;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Edit Movie</h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title:</label>
        <input type="text" name="title" value="<?= htmlspecialchars($movie['title']) ?>" required>

        <label>Genre:</label>
        <input type="text" name="genre" value="<?= htmlspecialchars($movie['genre']) ?>" required>

        <label>Release Date:</label>
        <input type="date" name="release_date" value="<?= htmlspecialchars($movie['release_date']) ?>" required>

        <label>Cast:</label>
        <input type="text" name="cast" value="<?= htmlspecialchars($movie['cast']) ?>" required>

        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($movie['description']) ?></textarea>

        <label>Change Poster Image:</label>
        <input type="file" name="image">

        <button type="submit">Update Movie</button>
    </form>
</div>

</body>
</html>
