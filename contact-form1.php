<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fname   = trim($_POST['fname'] ?? '');
    $phone   = trim($_POST['phone'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $message = trim($_POST['msg'] ?? '');

    if (!empty($fname) && !empty($email)) {

        $to = "info@energyinspectionksa.com";
        $subject = "New Contact Form Inquiry";

        $body = "
        <html>
        <body>
        <h3>New Contact Form Submission</h3>

        <table border='1' cellpadding='8' cellspacing='0'>
            <tr><td><strong>Full Name</strong></td><td>$fname</td></tr>
            <tr><td><strong>Email</strong></td><td>$email</td></tr>
            <tr><td><strong>Phone</strong></td><td>$phone</td></tr>
            <tr><td><strong>Message</strong></td><td>" . nl2br(htmlspecialchars($message)) . "</td></tr>
        </table>

        </body>
        </html>
        ";

        $headers  = "MIME-Version: 1.0\r\n";
        $headers .= "Content-type:text/html; charset=UTF-8\r\n";
        $headers .= "From: Energy Inspection Website <info@energyinspectionksa.com>\r\n";
        $headers .= "Reply-To: $email\r\n";

   if (mail($to, $subject, $body, $headers)) {
            echo json_encode([
                "status" => "Success",
                "msg" => "Thank you for contacting us. We will get back to you shortly."
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "msg" => "Mail could not be sent."
            ]);
        }

    } else {
        echo json_encode([
            "status" => "error",
            "msg" => "Please fill in the required fields."
        ]);
    }

} else {
    echo json_encode([
        "status" => "error",
        "msg" => "Invalid request."
    ]);
}
?>