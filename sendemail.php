<?php
    $name = isset($_POST['name']) ? trim(stripslashes($_POST['name'])) : '';
    $email = isset($_POST['email']) ? trim(stripslashes($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? trim(stripslashes($_POST['subject'])) : 'Contact Form Submission';
    $phone = isset($_POST['phone']) ? trim(stripslashes($_POST['phone'])) : 'N/A';
    $message = isset($_POST['message']) ? trim(stripslashes($_POST['message'])) : '';

    $email_to = 'info@distinctadvocacy.org';

    $body = "Name: " . $name . "\n\n";
    $body .= "Email: " . $email . "\n\n";
    $body .= "Phone: " . $phone . "\n\n";
    $body .= "Subject: " . $subject . "\n\n";
    $body .= "Message:\n" . $message . "\n";

    $headers = 'From: DAYEHS Contact Form <' . ($email ? filter_var($email, FILTER_SANITIZE_EMAIL) : $email_to) . '>' . "\r\n";
    $headers .= 'Reply-To: ' . ($email ? filter_var($email, FILTER_SANITIZE_EMAIL) : $email_to) . "\r\n";

    $success = false;
    if (!empty($name) && !empty($email) && !empty($message)) {
        $success = @mail($email_to, $subject, $body, $headers);
    }

    // Return JSON if request is AJAX, otherwise redirect with query status
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => $success ? 'success' : 'error',
            'message' => $success ? 'Thank you for reaching out to DAYEHS. We will get back to you shortly!' : 'Failed to send message. Please try again.'
        ]);
        exit;
    }

    header("Location: contact-us.html?status=" . ($success ? "success" : "error"));
    exit;