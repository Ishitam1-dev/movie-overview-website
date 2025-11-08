<?php

// Connect to database
$conn = mysqli_connect("localhost", "root", "", "movie-overview");
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Insert review if form submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit_review'])) {
    $movie = trim($_POST["movie"]);
    $author = trim($_POST["author"]);
    $content = trim($_POST["content"]);

    if (!empty($movie) && !empty($author) && !empty($content)) {
        $stmt = $conn->prepare("INSERT INTO reviews (movie, author, content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $movie, $author, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php?review=success#reviews");
        exit();
    }
}

// Fetch reviews
$sql = "SELECT * FROM reviews ORDER BY id DESC";  // or use created_at DESC
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Movie Reviews</title>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        body {
            background-color: #000;
            font-family: Arial, sans-serif;
        }
        .review-section {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            justify-content: center;
            background: #000000;
        }

        .review-card {
            background: #fff;
            border: 2px solid red;
            border-radius: 10px;
            padding: 16px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s ease;
        }

        .review-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
        }

        .review-card h3 {
            font-size: 18px;
            margin-bottom: 6px;
            color: #FFC107;
            text-align: center;
        }

        .review-card p {
            margin: 6px 0;
            color: #444;
            text-align: center;
        }

        .review-content {
            font-style: italic;
        }

        h2 {
            color: white;
            text-align: center;
            margin-top: 30px;
        }

        form {
            text-align: center;
            margin-bottom: 20px;
        }

        input, textarea {
            padding: 8px;
            margin: 6px;
            width: 250px;
        }

        input[type="submit"] {
            width: auto;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-top: 30px;">
    <a href="index.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Home</a>
    <a href="popular.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Popular</a>
    <a href="top-rated.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Top-rated</a>
    <a href="upcoming.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Upcoming </a>
  </div>


<h2>User Reviews</h2>

<!-- Review cards -->
<div class="review-section">
    
<?php

if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='review-card' data-aos='fade-up'>";
        echo "<h3><span style='color: #007BFF;'>" . htmlspecialchars($row['movie']) . "</span></h3>";
        echo "<p><strong>Reviewed by:</strong> " . htmlspecialchars($row['author']) . "</p>";
        echo "<p class='review-content'>" . htmlspecialchars($row['content']) . "</p>";
        echo "</div>";
    }
} else {
    echo "<p style='color: white;'>No reviews yet.</p>";
}
?>
</div> 

<!-- Review form -->
<form method="post" action="">
    <input type="text" name="movie" placeholder="Movie Name" required><br>
    <input type="text" name="author" placeholder="Your Name" required><br>
    <textarea name="content" placeholder="Write your review" required></textarea><br>
    <input type="submit" name="submit_review" value="Submit Review">
</form>
<h3>Back to Website</h3>
 <div style="text-align: center;">
    <a href="index.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">Back To Website!!</a>
  </div>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</body>
</html>
