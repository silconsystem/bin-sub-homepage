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
        // ... Rest of your script logic ...
        echo "Email sent successfully!";
    } else {
        echo "Error sending email. Please try again later.";
    }
}
?>
