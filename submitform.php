<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = strip_tags(trim($_POST["name"]));
  $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
  $message = trim($_POST["message"]);

  if (empty($name) || empty($email) || empty($message)) {
    http_response_code(400);
    echo "Please fill in all fields.";
    exit;
  }

  $recipient = "mdibrahimsohaib@gmail.com";
  $subject = "New contact form message from $name";
  $email_content = "Name: $name\n";
  $email_content .= "Email: $email\n\n";
  $email_content .= "Message:\n$message\n";

  $email_headers = "From: $name <$email>";

  if (mail($recipient, $subject, $email_content, $email_headers)) {
    http_response_code(200);
    echo "Thank you! Your message has been sent.";
  } else {
    http_response_code(500);
    echo "An error occurred. Please try again.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission. Please try again.";
}
?>
