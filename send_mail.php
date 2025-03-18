<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars($_POST['name']);
    $number = htmlspecialchars($_POST['number']);
    $message = htmlspecialchars($_POST['message']);

    $to = "your_email@example.com"; // Change this to your email
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nNumber: $number\nMessage:\n$message";

    $headers = "From: no-reply@yourwebsite.com\r\n";
    $headers .= "Reply-To: $number\r\n";

    if (mail($to, $subject, $body, $headers)) {
        echo "Message sent successfully!";
    } else {
        echo "Failed to send the message. Please try again.";
    }
} else {
    echo "Invalid request method.";
}
?>
