<?php
$pageTitle = "Upcoming Releases";
include 'header.php';

// Hardcoded upcoming movies data
$upcomingMovies = [
    ["title" => "War 2", "release_date" => "August 20, 2025", "trailer" => "https://www.youtube.com/embed/PlsUPeje14M"],
        ["title" => "jolly LLB.3", "release_date" => "September 19, 2025", "trailer" => "https://www.youtube.com/embed/UUwAnIu3dfU"],
        ["title" => "RAMAYANAM", "release_date" => "Diwali, 2025", "trailer" => "https://www.youtube.com/embed/gzUu-FJ7s-Y"],
        ["title" => "De De Pyar De 2", "release_date" => "December 20, 2025", "trailer" => "https://www.youtube.com/embed/WgAIllGyzQs"],
        ["title" => "Sunny Sanskari Ki Tulsi Kumari", "release_date" => "2 octomber, 2025", "trailer" => "https://www.youtube.com/embed/9FUd-D4FWjw"],
        ["title" => "The Bengal Files", "release_date" => "July 12, 2025", "trailer" => "https://www.youtube.com/embed/XuZTeiQoHoU"]
];
?>

<main>
  <h2>Upcoming Releases</h2>
  <?php foreach($upcomingMovies as $movie): ?>
    <div class="movie" style="flex-direction: column;">
      <h3><?php echo $movie['title']; ?></h3>
      <p><strong>Release Date:</strong> <?php echo $movie['release_date']; ?></p>
      <iframe width="560" height="315" src="<?php echo $movie['trailer']; ?>" frameborder="0" allowfullscreen></iframe>
    </div>
  <?php endforeach; ?>
</main>

<?php include 'footer.php'; ?>
