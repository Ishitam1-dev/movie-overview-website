<?php
$conn = mysqli_connect("localhost", "root", "", "movie-overview");
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$reviewMessage = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_review'])) {
    $movie = trim($_POST["movie"]);
    $author = trim($_POST["author"]);
    $content = trim($_POST["content"]);

    if ($movie && $author && $content) {
        $stmt = $conn->prepare("INSERT INTO reviews (movie, author, content) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $movie, $author, $content);
        $stmt->execute();
        $stmt->close();
        header("Location: index.php?review=success#reviews");
        exit();
    } else {
        $reviewMessage = "❌ Please fill in all fields.";
    }
}
$sql = "SELECT * FROM reviews ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Movie Overview</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="css/aos.css">
<script>
(function(){
  // quick beep
  try {
    const ctx = new (window.AudioContext || window.webkitAudioContext)();
    const o = ctx.createOscillator(); const g = ctx.createGain();
    o.type='sine'; o.frequency.value=880; g.gain.value=0.02;
    o.connect(g); g.connect(ctx.destination); o.start();
    setTimeout(()=> { o.stop(); ctx.close(); }, 120);
  } catch(e){/* no sound in some browsers */ }

  // confetti elements
  const container = document.createElement('div');
  Object.assign(container.style, {position:'fixed', left:0, top:0, width:'100%', height:'0', pointerEvents:'none', zIndex:99999});
  document.body.appendChild(container);
  const colors = ['#ff4d4f','#ffd666','#73d13d','#40a9ff','#9254de'];
  for(let i=0;i<40;i++){
    const c = document.createElement('div');
    const size = 6+Math.random()*12;
    Object.assign(c.style,{
      position:'absolute', left: Math.random()*100+'%', top:'-10px',
      width:size+'px', height:size+'px', background: colors[Math.floor(Math.random()*colors.length)],
      transform: 'rotate('+ (Math.random()*360)+'deg)', opacity:0.95, borderRadius:'2px'
    });
    container.appendChild(c);
    c.animate([
      {transform: c.style.transform, top: '-10px', opacity:1},
      {transform: 'translateY(90vh) rotate(360deg)', top:'90vh', opacity:0.9}
    ], {duration:1500+Math.random()*1500, easing:'cubic-bezier(.2,.8,.2,1)'});
  }
  setTimeout(()=> container.remove(), 3200);
})();
</script>

 
</head>


<body>
  <header>
    


    
    <h1 style="text-align: center; font-family: 'Segoe UI', sans-serif; font-size: 48px; font-weight: bold; margin-top: 30px;">
  <span style="color: #007BFF;">BOLLY</span>
  <span style="display: inline-block; background-color: #007BFF; color: white; padding: 8px 20px; border-radius: 8px; font-style: italic; font-weight: normal;">
    Buzz
  </span>
</h1>
<h3 style="text-align: center;">~we find the best movie for you!!</h3>

    <div style="text-align: center; font-size: 20px; margin-top: 30px; margin-bottom: 10px;">
    <nav>
      <a href="#home" style="text-decoration: underline;">Home</a> |
      <a href="popular.php" style="text-decoration: underline;">Popular Movies</a> |
      <a href="top-rated.php" style="text-decoration: underline;">Top Rated</a> |
      <a href="upcoming.php" style="text-decoration: underline;">Upcoming movies</a> |
      <a href="index2.php" style="text-decoration: underline;">Reviews</a> |
      <a href="contact.php" style="text-decoration: underline;">Add reviews</a>
      
    </nav>
  </div>
  </header>
  

  <main>

    <!-- Home Section -->
     <section id="home">
    <h2 style="text-align: center; font-family: 'Segoe UI', sans-serif; color: #F0F2F5; margin-bottom: 10px;">
  bollywood Movies , Reviews & More!!
</h2>

<h2 style="color: #FFC107">BollyBuzz Picks</h2>


    <div class="simple-slider">
  <button class="slider-btn prev">&#10094;</button>
  
  <div class="slider-container">
    <div class="slider-track">
      <div class="slider-item"><img src="image/paramsundari.jpg" alt="Movie 1">      <div class="slider-caption">
  <h2>Param Sundari</h2>
  <p><strong>Release Date:</strong> august,2025</p>
  <p><strong>Genre:</strong> Rom-Com Drama</p>
  
  <p><strong>Cast:</strong> Sidharth Malhotra, Janhvi Kapoor</p>
  <p><strong>Synopsis:</strong> Param & sundari collide as a North and South Indian unexpectedly fall for each other. Their diverse backgrounds ignite a comedic and tumultuous love story, brimming with cultural misadventures.</p>
  
  
</div></div>

 <?php
// if not already included at the top
  $sql = "SELECT * FROM movies ORDER BY id DESC LIMIT 5";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) {
      echo "<div class='slider-item'>";
      echo "<img src='image/" . $row['image'] . "' alt='" . $row['title'] . "'>";
      echo "<div class='slider-caption'>";
      echo "<h2>" . $row['title'] . "</h2>";
       $releaseDate = date("F, Y", strtotime($row['release_date']));
    echo "<p><strong>Release Date:</strong> $releaseDate</p>"; 
      echo "<p><strong>Genre:</strong> " . $row['genre'] . "</p>";
      echo "<p><strong>Cast:</strong> " . $row['cast'] . "</p>";
      echo "<p><strong>Synopsis:</strong> " . $row['description'] . "</p>";
      echo "<a href='review.php?id=" . $row['id'] . "' class='read-more-btn'>Read More</a>";

      echo "</div>";
      echo "</div>";
  }
  ?>


      <div class="slider-item"><img src="image/uri.jpg" alt="Movie 2">
        <div class="slider-caption">  <h2>URI:The Surgical Strike</h2>
  <p><strong>Release Date:</strong> january,2019</p>
  <p><strong>Genre:</strong> Action/war Drama</p>
  
  <p><strong>Cast:</strong> Vicky Kaushal, Yami Gautam</p>
  <p><strong>Synopsis:</strong>Major Vihaan Singh Shergill of the Indian Army leads a covert operation against a group of militants who attacked a base in Uri, Kashmir, in 2016 and killed many soldiers.</p>
  
  
</div></div>

 <div class="slider-item"><img src="image/devdas.jpg" alt="Movie 2">
        <div class="slider-caption">  <h2>Devdas</h2>
  <p><strong>Release Date:</strong> July, 2002</p>
  <p><strong>Genre:</strong> Romance/Musical Drama</p>
  
  <p><strong>Cast:</strong> Shah Rukh Khan, Aishwarya Rai Bachchan, Madhuri Dixit</p>
  <p><strong>Synopsis:</strong>After dev's wealthy family prohibits him from marrying the woman he is in love with, Devdas's life spirals downward as he takes up alcohol and a life of vice to alleviate the pain.</p>
  
  
</div></div>

 <div class="slider-item"><img src="image/bhagmilkha.jpg" alt="Movie 2">
        <div class="slider-caption">  <h2>Bhaag Milkha Bhaag</h2>
  <p><strong>Release Date:</strong> july,2013</p>
  <p><strong>Genre:</strong> Sport/Action Drama</p>
  
  <p><strong>Cast:</strong> Farhan Akhtar, Sonam Kapoor</p>
  <p><strong>Synopsis:</strong>Milkha Singh, an Indian athlete, overcomes many agonising obstacles in order to become a world champion, Olympian and one of India's most iconic athletes.</p>
  
  
</div></div>
      <div class="slider-item"><img src="image/sos2.jpg" alt="Movie 3">
        <div class="slider-caption">
  <h2>Son Of Sardar 2</h2>
  <p><strong>Release Date:</strong> July, 2025</p>
  <p><strong>Genre:</strong> comedy drama</p>
  
  <p><strong>Cast:</strong> Ajay Devgan, Mrunal Thakur
</p>
  <p><strong>Synopsis:</strong>In a village, 12-year-old Aarav and friends participate in the annual Mango Festival hunt for a rare golden mango. They face challenges, rivalries, learn teamwork and the festival's meaning of unity, strengthening their bonds upon finding the mango.</p>
  </div></div>
      <div class="slider-item"><img src="image/sitare.jpg" alt="Movie 3">
        <div class="slider-caption"><h2>Sitare Zameen Par</h2>
  <p><strong>Release Date:</strong> june,2025</p>
  <p><strong>Genre:</strong>Inspring/comedy  drama</p>
  
  <p><strong>Cast:</strong>Genelia, Aamir Khan
</p>
  <p><strong>Synopsis:</strong>A basketball coach serves community service by training Neurodivergent adults after a DUI. His outlook changes as he learns from his players.</p></div></div>
      <div class="slider-item"><img src="image/pushpa.jpg" alt="Movie 3">

        <div class="slider-caption">
<h2>Pushpa</h2>
  <p><strong>Release Date:</strong> December, 2021 </p>
  <p><strong>Genre:</strong>Action/Thriller drama</p>
  
  <p><strong>Cast:</strong>Allu Arjun, Rashmika Mandana
</p>
  <p><strong>Synopsis:</strong>A labourer named Pushpa makes enemies as he rises in the world of red sandalwood smuggling. However, violence erupts when the police attempt to bring down his illegal business.</p></div></div>
    </div>
  </div>
  

  <button class="slider-btn next">&#10095;</button>
</div>
</section>
<hr style="border: none; height: 2px; background-color: #333;">



    <!-- Popular Movies Section -->
    <section id="popular">
      <h2>Popular Movies</h2>
      <?php
$popularMovies = [
    ["title" => "title:CHENNAI EXPRESS",
     "image" => "image/chennai.jpg",
      "Release Date" => "Release date:8 August 2013",
       "Genre" => "Genre:Thriller/comedy", 
       "Duration" => "Duration:2 hour 21 minutes", 
       "Director" => "Director:Rohit shetty",
         "description" => "Description:Rahul, a young man, sets out to immerse his late grandfather's ashes at Rameshwaram. However, when he helps Meena, a runaway bride, board a train, he has to face the ire of her criminal family.", "Starring" => "Starring:Deepika Padukone; Shah Rukh Khan",
          "IMDb" => "IMDb:6.2/10",
           "Review" => "Bolly-Buzz Review:    Chennai Express - A pretty entertaining film with a good story. Actually Ive seen several films like this ( maryada ramanna ) So the story is good but not that fresh. But you can watch this and enjoy your time with amazing bgm and songs with good humour elements and the last fight was 👌👌 Started to become an SRK Fan!! Om Shanti Om is the best film of SRK. But this film is a perfect entertainer. But some humour felt cringey to me. That's all. Had good time watching it." ],

    ["title" => "title:SHOLAY",
     "image" => "image/sholay.jpg",
      "Release Date" => "Release date:15 august,1975",
       "Genre" => "Genre:comedy/Action", 
       "Duration" => "Duration:3 hour 24 minutes", 
       "Director" => "Director:Ramesh Sippy",
     "description" => "Description:Jai and Veeru, two ex-convicts, are hired by Thakur Baldev Singh, a retired policeman, to help him nab Gabbar Singh, a notorious dacoit, who has spread havoc in the village of Ramgarh.",
    "Starring" => "Starring:Amitabh Bachchan;Hema Malini;Dharmendra",
          "IMDb" => "IMDb:8.2/10",
         "Review" => "Bolly-Buzz Review:     We all know Sholay and we all love Sholay. It is a benchmark in Indian cinema and each one of us has his own story to tell about the classic. From seeing it more than 50 times to purchasing ticket in black for an obscene amount or memorising every dialogue, personal stories around the legendary film abound." ],
     ["title" => "title:JODHA AKHBAR",
     "image" => "image/jodhaakhbar.jpg",
      "Release Date" => "Release date:15 February 2008",
       "Genre" => "Genre:Romance/war", 
       "Duration" => "Duration:3 hour 33 minutes", 
       "Director" => "Director:Ashutosh Gowariker
",
     "description" => "Description:Jodhaa is a fiery Rajput princess who is obliged to marry Mughal Emperor Akbar for political reasons. Eventually, mutual respect and admiration between the duo leads to true love.",
    "Starring" => "Starring:Hritik Roshan;Aishwariya Rai",
          "IMDb" => "IMDb:7.5/10",
         "Review" => "Bolly-Buzz Review:     *Jodhaa Akbar*, directed by Ashutosh Gowariker, intricately weaves a tapestry of love, politics, and religious tolerance against the grand backdrop of the Mughal Empire. This historical epic, set in the 16th century, immerses the audience in the life of Emperor Akbar, brilliantly portrayed by Hrithik Roshan, and his unlikely romance with the fiery Rajkumari Jodhaa Bai, played with grace and strength by Aishwarya Rai Bachchan.
" ] ,
["title" => "title:RRR",
     "image" => "image/rrr.jpg",
      "Release Date" => "Release date: 24 March ,2022",
       "Genre" => "Genre:Action/Adventure", 
       "Duration" => "Duration:3 hour 02 minutes", 
       "Director" => "Director:S. S. Rajamouli
",
     "description" => "Description:A fearless revolutionary and an officer in the British force, who once shared a deep bond, decide to join forces and chart out an inspirational path of freedom against the despotic rulers..",
    "Starring" => "Starring:Ram Charan; N. T. Rama rao, Alia Bhatt",
          "IMDb" => "IMDb:7.8/10",
         "Review" => "Bolly-Buzz Review:     NTR and Ram Charan have competed with each other in giving the best performances to date. Their meeting, confrontational scenes together are completely new and exciting for the audience. It is needless to say how Rajamouli makes his actors look well built, but the emotions and the body language are so well given by the actors.
" ],
["title" => "title:HUM AAPKE HAI KON",
     "image" => "image/humaapke.jpg",
      "Release Date" => "Release date:  5 August, 1994",
       "Genre" => "Genre:Musical/Romance", 
       "Duration" => "Duration:3 hour 02 minutes", 
       "Director" => "Director:Sooraj Barjatya
",
     "description" => "Description:When Prem meets his brother Rajesh's sister-in-law, Nisha, the two fall in love. However, fate has other plans for the lovers when Nisha's sister unexpectedly dies and she is expected to marry Rajesh.",
    "Starring" => "Starring:Salman Khan; Madhuri dixit",
          "IMDb" => "IMDb:8.8/10",
         "Review" => "Bolly-Buzz Review:     Hum Aapke Hain Koun* is a timeless family drama that beautifully weaves together love, relationships, and sacrifice. Directed by Sooraj Barjatya, the film follows the lives of two families intertwined by love and friendship. The story revolves around Prem (Salman Khan) and Nisha (Madhuri Dixit), who find themselves in a whirlwind of emotions when a tragedy strikes the family.
" ],  
   ["title" => "title:JAB WE MET",
     "image" => "image/jabwemet.jpg",
      "Release Date" => "Release date:  26 October ,2007",
       "Genre" => "Genre:comady/Romance", 
       "Duration" => "Duration:2 hour 18 minutes", 
       "Director" => "Director:Imtiaz Ali
",
     "description" => "Description:Aditya, a heartbroken tycoon on the verge of committing suicide, aimlessly boards a train. He meets Geet, a bubbly girl who plans to elope with her lover, and finds himself pulled into her crazy life.",
    "Starring" => "Starring:Sahid Kapoor;Kareena Kapoor",
          "IMDb" => "IMDb:7.9/10",
         "Review" => "Bolly-Buzz Review:     The little moments that Imtiaz Ali came up with throughout the movie had a sparkling effect. The moment when Geet asks Aditya if she finds him cute playfully was really subtle but lovely. Aditya's light and casual talks with Geet kept us smiling throughout the film. I feel Imtiaz stretched it a bit at the last, but overall it was an amazing watch. And how can one forget to mention those amazing songs. That dance in the rain has my heart. Beautiful movie.
" ],
["title" => "title:CHHAVA",
     "image" => "image/chhava1.jpg",
      "Release Date" => "Release date:14 February, 2025",
       "Genre" => "Genre:historical", 
       "Director" => "Director:Laxman Utekar",
       "Duration" => "Duration:2 hour 41 minutes", 

     "description" => "Description:Shivaji's death sparks the Maratha-Mughal conflict. His son Sambhaji leads resistance against Aurangzeb's forces. Amid battles and intrigue, both sides face challenges in a struggle for power.",
    "Starring" => "Starring:Vicky Kaushal;Akshay Khanna,Rashmika Mandana",
          "IMDb" => "IMDb:7.3/10",
         "Review" => "Bolly-Buzz Review:     Bollywood has produced many remarkable historical films, but Chhaava stands out as a true cinematic triumph. From its outstanding performances to breathtaking visuals, a soul-stirring background score, and carefully crafted costumes, every element of this film is executed with precision and passion.
" ]     
   
   
    
];
   
foreach ($popularMovies as $movie): ?>
  <div class="movie-card" >
    
    <img class="movie-img" src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
    <div class="movie-info" data-aos="slide-up">
      <h2><?php echo $movie['title']; ?></h2>
      <p><?php echo $movie['Release Date']; ?></p>
      <p><?php echo $movie['Genre']; ?></p>
      <p><?php echo $movie['Duration']; ?></p>
      <p><?php echo $movie['Director']; ?></p>
      <p><?php echo $movie['description']; ?></p>
      <p><?php echo $movie['Starring']; ?></p>
      <h3><?php echo $movie['IMDb']; ?></h3>
      <p><?php echo $movie['Review']; ?></p>
    </div>
    
  </div>
<?php endforeach; ?>
</section>

<hr style="border: none; height: 2px; background-color: #333;">


    <!-- Top Rated Section -->
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


    <!-- Upcoming Releases Section -->
    <section id="upcoming">
      <h2>Upcoming Releases</h2>
      

      <section id="upcoming" style="padding: 20px;">
  <h2 style="color: white;">Upcoming Movies</h2>
  <div class="upcoming-row">
    <?php
    $upcomingMovies = [
        ["title" => "War 2", "release_date" => "December 20, 2025", "trailer" => "https://www.youtube.com/embed/PlsUPeje14M"],
        ["title" => "jolly LLB.3", "release_date" => "May 5, 2025", "trailer" => "https://www.youtube.com/embed/UUwAnIu3dfU"],
        ["title" => "RAMAYANAM", "release_date" => "July 12, 2025", "trailer" => "https://www.youtube.com/embed/gzUu-FJ7s-Y"],
        ["title" => "De De Pyar De 2", "release_date" => "December 20, 2025", "trailer" => "https://www.youtube.com/embed/WgAIllGyzQs"],
        ["title" => "Sunny Sanskari Ki Tulsi Kumari ", "release_date" => "septmber 19, 2025", "trailer" => "https://www.youtube.com/embed/9FUd-D4FWjw"],
        ["title" => "The Bengal Files", "release_date" => "July 12, 2025", "trailer" => "https://www.youtube.com/embed/XuZTeiQoHoU"]
    ];
    foreach ($upcomingMovies as $movie): ?>
      <div class="trailer-card">
        <iframe width="300" height="170" src="<?php echo $movie['trailer']; ?>" frameborder="0" allowfullscreen></iframe>
        <h4><?php echo $movie['title']; ?></h4>
        <p><strong>Release:</strong> <?php echo $movie['release_date']; ?></p>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<hr style="border: none; height: 2px; background-color: #333;">


    <!-- Reviews Section -->
     <section id="reviews">
       <h2>User Reviews</h2>
    <?php
$reviews = [
    ["movie" => "War 2", "author" => "Aarav Mehta", "content" => "Action-packed and intense! Hrithik is on fire again."],
    ["movie" => "Jolly LLB 3", "author" => "Neha Sharma", "content" => "Loved the courtroom drama. Akshay delivers once more."],
    ["movie" => "Ramayanam", "author" => "Ravi Patel", "content" => "Visually stunning. A grand retelling of a classic."],
    ["movie" => "De De Pyar De 2", "author" => "Simran Kaur", "content" => "Romantic and funny! Great weekend watch."],
    ["movie" => "The Bengal Files", "author" => "Ishita Makdiya", "content" => "Very emotional and eye-opening. A must-watch."]
];
?>

<div class="review-section">
  <?php foreach ($reviews as $review): ?>
    <div class="review-card" data-aos="fade-up">
      <h3  style="text-align: center; font-family: 'Segoe UI', sans-serif; font-weight: bold; margin-top: 30px;">
 <span style="color: #007BFF;">
  <?php echo htmlspecialchars($review['movie']); ?></span></h3>
      <p style="text-align: center;"><strong>Reviewed by:</strong> <?php echo htmlspecialchars($review['author']); ?></p>
      <p style="text-align: center;" class="review-content"><?php echo htmlspecialchars($review['content']); ?></p>
    </div>
  <?php endforeach; ?>
</div>


   
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div class='review' data-aos='fade-up'>";
            echo "<h3>" . htmlspecialchars($row['movie']) . "</h3>";
            echo "<p><strong>" . htmlspecialchars($row['author']) . " says:</strong> " . htmlspecialchars($row['content']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet. Be the first to add one!</p>";
    }
    ?>
    
    <div style="text-align: center;  margin-top: 90px; margin-bottom: 30px;">
    <a href="index2.php" class="btn" style="background-color:#007BFF;  padding:10px 20px; border-radius:5px;">See All Latest Reviews</a>
  </div>
</section>


   


<hr style="border: none; height: 2px; background-color: #333;">


    <!-- Contact Section -->
   <h2 style="margin-top: 40px;">Submit Your Review</h3>




<!-- START OF REVIEWS SECTION -->



 <section id="contact">


<form method="post" action="index.php#reviews">
    <label for="movie">Movie Title:</label>
    <input type="text" name="movie" id="movie" required>

    <label for="author">Your Name:</label>
    <input type="text" name="author" id="author" required>

    <label for="content">Your Review:</label>
    <textarea name="content" id="content" rows="4" required></textarea>

    <button type="submit" name="submit_review">Submit Review</button>
</form>
</section>

<section id="contact us">
  <div style="text-align: center;">
<h2 >Contact Us</h2>
<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $messageContent = htmlspecialchars(trim($_POST['message']));
    
    if ($name && $email && $messageContent) {
        // For now just show a thank you message — no email sending setup
        $message = "Thank you, $name! Your message has been received.";
    } else {
        $message = "Please fill in all fields.";
    }
}
?>

  <?php if($message): ?>
    <p style="color: #66ccff;"><?php echo $message; ?></p>
  <?php endif; ?>

  <form method="post" action="contact.php">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required />
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required />
    
    <label for="message">Message:</label>
    <textarea name="message" id="message" rows="5" required></textarea>
    
    <button type="submit">Send</button>
  </form>
  </div>
</section>

  </main>

  <footer style="background:#111; color:#ddd; padding:30px 0; text-align:center;">
    <div style="max-width:1100px; margin:auto; display:grid; grid-template-columns: repeat(auto-fit, minmax(250px,1fr)); gap:20px;">
        
        <div>
            <h3>About Us</h3>
            <p>Bollywood Reviews brings you honest and updated movie reviews, ratings, and recommendations. 
            Discover the best of Bollywood with us.</p>
        </div>
        
        <div>
            <h3>Quick Links</h3>
            <ul style="list-style:none; padding:0;">
                <li><a href="index.php" style="color:#ddd;">Home</a></li>
                <li><a href="popular.php" style="color:#ddd;">Popular Movies</a></li>
                <li><a href="toprated.php" style="color:#ddd;">Top Rated</a></li>
                <li><a href="upcoming.php" style="color:#ddd;">Upcoming</a></li>
                <li><a href="reviews.php" style="color:#ddd;">Reviews</a></li>
                <li><a href="contact.php" style="color:#ddd;">Contact Us</a></li>
            </ul>
        </div>
        
        <div>
            <h3>Contact</h3>
            <p>Junagadh, India</p>
            <p>Email: contact@bollywoodreviews.com</p>
            <p>Phone: +91 98765 43210</p>
        </div>
        
    </div>
    <hr style="margin:20px 0; border:0.5px solid #333;">
    <p>© 2025 Bollywood Reviews. All rights reserved. | Designed by <strong>Ishita & Armi</strong></p>
</footer>

  

<script src="js/main.js"></script>

<script src="js/aos.js"></script>
<script>
  AOS.init();
</script>
</body>
</html>
