<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted message, email, and mailing list preference
    $message = $_POST["message"];
    $email = $_POST["email"];
    $mailingListPreference = isset($_POST["mailing_list"]) ? $_POST["mailing_list"] : "no";

    // Database connection details
    $host = "localhost";
    $dbname = "rvpbyzfo_binsub-data";
    $username = "rvpbyzfo_admin";
    $password = "S^H5L*VP09nX";

    // Construct the email message for your records
    $adminEmailMessage = "You have a new message:\n$message\nFrom: $email\nAdded to mailing list: $mailingListPreference";

    // Initialize the added message for the user
    $addedMessage = "https://binauralsubliminal.com\nhttps://twitter.com/SONICLABOR\nhttps://youtube.com/TheCultofshiva\nhttps://soundcloud.com/cultofshiva\nhttps://soundcloud.com/binaural_sub\n\n";

    try {
        // Create a PDO instance
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL query
        $stmt = $pdo->prepare("INSERT INTO subscribers (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Close the database connection
        $pdo = null;

        // Send an email to the administrator
        mail("binaural_sub303@protonmail.com", "New Form Submission", $adminEmailMessage, "From: $email");

        // Set user confirmation email content
        $userSubject = "Thank you for your submission";
        $userMessage = "Dear user, \n\nThank you for your submission. We have received your message and will get back to you as soon as possible.\n\nBest regards,\nYour Website Team";

        // Check mailing list preference and add corresponding message
        if ($mailingListPreference == 'yes') {
            $userMessage .= "\n\nYou have been added to our mailing list. If you want to unsubscribe, let us know by email or use the contact form.";
        } elseif ($mailingListPreference == 'no') {
            $userMessage .= "\n\nYou are not on our mailing list. If you want to be added, use the contact form again or email us.";
        }

        // Add the $addedMessage link
        $userMessage .= "\n\n$addedMessage";

        // Send a confirmation email back to the user
        mail($email, $userSubject, $userMessage);

        // Redirect to thanks.html
        header("Location: thanks.html");
        exit(); // Make sure to exit after the redirect to prevent further script execution
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
