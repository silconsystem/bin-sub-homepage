<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted message, email, and mailing list preference
    $message = $_POST["message"];
    $email = $_POST["email"];
    $mailingListPreference = isset($_POST["mailing_list"]) ? $_POST["mailing_list"] : "no";

    // Your email address
    $to = "binaural_sub303@protonmail.com";

    // Subject
    $subject = "New Form Submission";

    // Construct the message body
    $emailMessage = "Message: $message\n";
    $emailMessage .= "Email: $email\n";
    $emailMessage .= "Add to Mailing List: $mailingListPreference";

    // Additional headers
    $headers = "From: $email";

    // Attempt to send the email
    if (mail($to, $subject, $emailMessage, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Error sending email. Please try again later.";
    }
}
?>
