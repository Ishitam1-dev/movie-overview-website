<html>
  <head>
    <style>
      .top-rated-container {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
}

.top-movie-card {
  position: relative;
  width: 200px;
  height: 300px;
  border-radius: 10px;
  overflow: hidden;
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
  transition: transform 0.3s;
}

.top-movie-card:hover {
  transform: scale(1.03);
}

.top-movie-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

.overlay {
  position: absolute;
  bottom: 0;
  width: 100%;
  background: rgba(0,0,0,0.7);
  color: #fff;
  padding: 10px;
  transform: translateY(100%);
  transition: transform 0.3s ease;
  text-align: center;
}

.top-movie-card:hover .overlay {
  transform: translateY(0);
}
    </style>
  </head>
<?php
$pageTitle = "Top Rated Movies";
include 'header.php';
?>


<!-- hardcoded top-rated movies data -->
<section id="top-rated">
  <h2>Top Rated Movies</h2>
  <div class="top-rated-container"> <!-- Wrapper div for flex layout -->
    <?php
    $topRatedMovies = [
        ["title" => "Dilwale Dulhania Le Jayenge", "image" => "image/ddlj.jpg", "rating" => "4.5/5"],
        ["title" => "12th Fail", "image" => "image/12thfail.jpg", "rating" => "4.8/5"],
        ["title" => "Mughal-E-Azam", "image" => "image/mughal.jpg", "rating" => "4.9/5"],
        ["title" => "Baahubali: The Beginning", "image" => "image/bahubali1.jpg", "rating" => "4.7/5"],
        ["title" => "Gangubai Kathiawadi", "image" => "image/gangubai.jpg", "rating" => "4.9/5"],
        ["title" => "Mary Kom", "image" => "image/marykom.jpg", "rating" => "4.6/5"],
         ["title" => "Salaam Bombay!", "image" => "image/salaam.jpg", "rating" => "4.4/5"],
        ["title" => "M.S. Dhoni: The Untold Story", "image" => "image/msdhoni.jpg", "rating" => "4.9/5"],
        ["title" => "Gullyboy", "image" => "image/gullyboy.jpg", "rating" => "4.5/5"],
        
        ["title" => "Shershaah", "image" => "image/shershaah.jpg", "rating" => "5/5"]
    ];
    foreach ($topRatedMovies as $movie): ?>
      <div class="top-movie-card">
        <img class="top-movie-img" src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
        <div class="overlay">
             <h3><?php echo $movie['title']; ?></h3>
             <p><?php echo $movie['rating']; ?></p>
          
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<hr style="border: none; height: 2px; background-color: #333;">


  
</main>

<?php include 'footer.php'; ?>
