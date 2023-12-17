<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verify reCAPTCHA
    $recaptchaSecretKey = '6Lc4yjMpAAAAAHfsUMuXML8LNCkuA4EjEkoyl2q-';
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
        'secret' => $recaptchaSecretKey,
        'response' => $recaptchaResponse
    );

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
    $resultJson = json_decode($result);

    // Check reCAPTCHA verification result
    if (!$resultJson->success) {
        // Handle reCAPTCHA verification failure
        echo "reCAPTCHA verification failed. Please go back and try again.";
        exit();
    }

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
