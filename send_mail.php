<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitize and validate inputs
    $name = htmlspecialchars(strip_tags(trim($_POST['name'] ?? '')));
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $number = htmlspecialchars(strip_tags(trim($_POST['number'] ?? '')));
    $message = htmlspecialchars(strip_tags(trim($_POST['message'] ?? '')));

    // Basic validation
    if (!$name || !$email || !$number || !$message) {
        echo "All fields are required.";
        exit;
    }

    // Initialize PHPMailer
    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        // Use environment variables for sensitive data
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Set a timeout to prevent hanging
        $mail->Timeout = 60;

        // Email Configuration
        $mail->setFrom($mail->Username, '888RV Construction and Supplies');
        $mail->addAddress($mail->Username, '888RV Construction and Supplies');
        $mail->addReplyTo($email, $name);

        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "
            <h3>New Contact Form Submission</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone Number:</strong> $number</p>
            <p><strong>Message:</strong><br>$message</p>
        ";

        $mail->SMTPDebug = 0;

        // Send email
        if ($mail->send()) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message. Please try again.";
        }

    } catch (Exception $e) {
        // Improved error message for debugging
        error_log("Mail Error: " . $mail->ErrorInfo);
        echo "Something went wrong. Please try again later.";
    }
} else {
    echo "Invalid request method.";
}
?>
