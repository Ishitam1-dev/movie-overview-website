<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php include '../backend/database.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add New Movie</title>
  <link rel="stylesheet" href="../css/style.css"> <!-- reuse your existing CSS -->
  <style>
    body {
      background-color: #000;
      color: #fff;
      font-family: Arial, sans-serif;
      padding: 40px;
    }

    .form-container {
      max-width: 600px;
      margin: auto;
      background: #1a1a1a;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(255, 255, 255, 0.1);
    }

    .form-container h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #ffc107;
    }

    .form-group {
      margin-bottom: 15px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input,
    .form-group textarea {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 8px;
      background: #333;
      color: #fff;
    }

    .form-group textarea {
      resize: vertical;
    }

    .form-group button {
      background: #ffc107;
      color: #000;
      padding: 10px 20px;
      border: none;
      border-radius: 8px;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
    }

    .form-group button:hover {
      background: #e0a800;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h2>Add New Movie</h2>
    <form action="process_add_movie.php" method="POST">
      <div class="form-group">
        <label>Title:</label>
        <input type="text" name="title" required>
      </div>

      <div class="form-group">
        <label>Genre:</label>
        <input type="text" name="genre" required>
      </div>

      <div class="form-group">
        <label>Release Date:</label>
        <input type="date" name="release_date" required>
      </div>

      
      

      <div class="form-group">
        <label>Cast:</label>
        <input type="text" name="cast" required>
      </div>

      

      <div class="form-group">
        <label>Image Filename (e.g., movie.jpg):</label>
        <input type="text" name="image" required>
      </div>

      <div class="form-group">
        <label>Description / Synopsis:</label>
        <textarea name="description" rows="4" required></textarea>
      </div>

      <div class="form-group">
        <button type="submit">Add Movie</button>
      </div>
    </form>
  </div>
</body>
</html>
