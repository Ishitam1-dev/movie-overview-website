<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<?php
include '../backend/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Movies</title>
  <link rel="stylesheet" href="../css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #111;
      color: white;
      padding: 20px;
    }
    h1 {
      text-align: center;
      color: #ffcc00;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #222;
      color: white;
      margin-top: 20px;
    }
    th, td {
      border: 1px solid #444;
      padding: 10px;
      text-align: center;
    }
    a.button {
      background: #ffcc00;
      color: black;
      padding: 6px 12px;
      border-radius: 2px;
      text-decoration: none;
      font-weight: bold;
    }
    a.button:hover {
      background: #ffa500;
    }
  </style>
</head>
<body>
  <h1>Manage Movies</h1>

  <table>
    <tr>
      <th>ID</th>
      <th>Poster</th>
      <th>Title</th>
      <th>Genre</th>
      <th>Release Date</th>
      <th>Cast</th>
      <th>Description</th>
    </tr>

    <?php
    $sql = "SELECT * FROM movies ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row['id'] . "</td>";
      echo "<td><img src='../image/" . $row['image'] . "' width='60'></td>";
      echo "<td>" . $row['title'] . "</td>";
      echo "<td>" . $row['genre'] . "</td>";
      echo "<td>" . $row['release_date'] . "</td>";
      echo "<td>" . $row['cast'] . "</td>";
       echo "<td>" . $row['description'] . "</td>";
     
      echo "<td>
        <a class='button' href='edit-movie.php?id=" . $row['id'] . "'>Edit</a>
        <a class='button' href='delete-movie.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>
      </td>";
      echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
