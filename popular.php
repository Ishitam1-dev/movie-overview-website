<?php include 'backend/database.php'; 
include 'popular_data.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Popular Movies</title>
    
    <style>
       body {
  background-color: #000000; /* Entire page background */
  color: #00aaff;            /* Blue text */
  margin: 0;
  font-family: Arial, sans-serif;
}


 .movie-container {
  display: flex;
  flex-wrap: wrap;         /* movies wrap to next line */
  justify-content: space-between;
  gap: 20px;
  margin-bottom: 40px;     /* push footer down */
}

.movie-card {
  flex: 0 0 calc(33.333% - 20px); /* 3 per row */
  box-sizing: border-box;
 
  padding: 10px;
  border-radius: 8px;
  text-align: center;
}




.movie-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.2);
}

 .movie-card img {
    width: 100%;
    height: 300px; /* fixed height for uniform grid */
    object-fit: cover;
    border-radius: 8px;



.movie-info {
  flex: 1;
}

.details-btn {
  background-color: #ff4d4d;
  color: white;
  padding: 8px 16px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
  opacity: 0;
  transform: translateY(10px);
  transition: 0.3s ease;
}

.movie-card:hover .details-btn {
  transform: translateY(0);
  opacity: 1;
}

    </style>
    </head>

      
<body>
 <header>
    <h1>Movie Overview</h1>
    <nav>
      <a href="index.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Home</a> |
      <a href="popular.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Popular Movies</a> |
      <a href="top-rated.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Top Rated</a> |
      <a href="upcoming.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Upcoming Releases</a> |
      <a href="index2.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Reviews</a> |
      <a href="contact.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Contact</a>
    </nav>
  </header>

 <section id="popular">
    <h2>Popular Movies</h2>
   
         <div class="movie-card" >
    <div class="movie-info" data-aos="fade-up">
      <div class="movie-container" >
        <?php
        $sql = "SELECT * FROM movies ORDER BY rating DESC LIMIT 10"; // Top 10 by rating
        $result = mysqli_query($conn, $sql);
        

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='movie-card'>";
            echo "<img src='image/" . $row['image'] . "' alt='" . $row['title'] . "'>";
            echo "<h3>" . $row['title'] . "</h3>";
            echo "<p>" . $row['genre'] . "</p>";
            echo "<p>".$row['release_date'] . "</p>";
            
            echo "<a href='review.php?id=" . $row['id'] . "'>Read More</a>";
            echo "</div>";
        }
        

   
foreach ($popularMovies as $movie): ?>
  <div class="movie-card" >
    
    <img class="movie-img" src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
    <div class="movie-info" data-aos="fade-up">
      <h2><?php echo $movie['title']; ?></h2>
      <p><?php echo $movie['release_date']; ?></p>
      <p><?php echo $movie['genre']; ?></p>
      <p><?php echo $movie['imdb']; ?></p>
      
      <a href="review.php?static=<?php echo urlencode($movie['title']); ?>">Read More</a>

    </div>
    
  </div>
<?php endforeach; ?>


        
    </div>
    </div>
    </section>
    
</body>
</html>
