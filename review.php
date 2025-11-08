<?php 
include 'backend/database.php'; 
include 'popular_data.php';
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>
    <?php 
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "SELECT * FROM movies WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $movie = mysqli_fetch_assoc($result);
        echo $movie['title'] . " - Review";
    } elseif (isset($_GET['static'])) {
        echo $_GET['static'] . " - Review";
    } else {
        echo "Movie Review";
    }
    ?>
  </title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
// 🎬 Case 1: Static movies
if (isset($_GET['static'])) {
    $title = $_GET['static'];
    $found = false;

    foreach ($popularMovies as $m) {
         if (strcasecmp($m['title'], $title) === 0) {
            ?>
            <div class="movie-details">
              <h2><?php echo $m['title']; ?></h2>
              <img src="<?php echo $m['image']; ?>" alt="<?php echo $m['title']; ?>">
              <p><strong>Release Date:</strong> <?php echo $m['release_date']; ?></p>
              <p><strong>Genre:</strong> <?php echo $m['genre']; ?></p>
              <p><strong>Duration:</strong> <?php echo $m['duration']; ?></p>
              <p><strong>Director:</strong> <?php echo $m['director']; ?></p>
              <p><strong>Starring:</strong> <?php echo $m['starring']; ?></p>
              <p><strong>IMDb:</strong> <?php echo $m['imdb']; ?></p>
              <p><strong>Review:</strong><br><?php echo $m['review']; ?></p>
            </div>
            <?php
            $found = true;
            break;
        }
    }

    if (!$found) {
        echo "<p>Movie not found!</p>";
    }
}

// 🎬 Case 2: Database movies
elseif (isset($_GET['id'])) {
    ?>
    <div class="movie-details">
      <h2><?php echo $movie['title']; ?></h2>
      <img src="image/<?php echo $movie['image']; ?>" alt="">
      <p><strong>Genre:</strong> <?php echo $movie['genre']; ?></p>
      <p><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
      <p><strong>Description:</strong><br><?php echo $movie['description']; ?></p>
    </div>
    <?php
}
?>

<script src="js/script.js"></script>
</body>
</html>
