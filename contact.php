<?php
$pageTitle = "Contact Us";
include 'header.php';

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

<main>
  <h2>Contact Us</h2>

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
</main>

<?php include 'footer.php'; ?>
