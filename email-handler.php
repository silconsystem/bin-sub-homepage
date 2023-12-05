<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Email recipient
    $to = "binaural_sub303@protonmail.com";

    // Subject
    $subject = "New Contact Form Submission";

    // Message
    $email_message = "Name: $name\n";
    $email_message .= "Email: $email\n";
    $email_message .= "Message:\n$message";

    // Additional headers
    $headers = "From: $email";

    // Send email
    mail($to, $subject, $email_message, $headers);

    // Redirect after sending email (you can customize the URL)
    header("Location: thanks.html");
    exit();
}
?>
