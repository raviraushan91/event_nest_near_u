<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Collect POST data safely
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$tickets = $_POST['tickets'] ?? '';
$event = $_POST['event'] ?? '';

// Generate random booking code (e.g., BK4A7F1D)
function generateBookingCode() {
    return 'BK' . strtoupper(bin2hex(random_bytes(3)));
}

// Generate random seat numbers (e.g., A1 to D20)
function generateSeatNumber() {
    $row = chr(rand(65, 68)); // A to D
    $number = rand(1, 20);
    return $row . $number;
}

// Create booking data
$bookingCode = generateBookingCode();
$seatNumbers = [];
for ($i = 0; $i < (int)$tickets; $i++) {
    $seatNumbers[] = generateSeatNumber();
}

// Send confirmation email using PHPMailer
$mail = new PHPMailer(true);
$emailSent = false;
$errorMsg = '';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ck667941@gmail.com';              // Your Gmail
    $mail->Password   = 'ohrj qcra pdkw nyrw';             // Your App Password (not Gmail password)
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    $mail->setFrom('ck667941@gmail.com', 'Event Nest by Chandan');
    $mail->addAddress($email, $name);

    $mail->isHTML(true);
    $mail->Subject = "Ticket Confirmation - $event";
    $mail->Body    = "
        <h3>Hello $name,</h3>
        <p>Thank you for booking <strong>$tickets</strong> ticket(s) for <strong>$event</strong>.</p>
        <p><strong>Booking Code:</strong> $bookingCode</p>
        <p><strong>Seat Numbers:</strong> " . implode(', ', $seatNumbers) . "</p>
        <p>Please show this email at the event gate.</p>
        <br>
        <em>Event Nest by Chandan</em>
    ";
    $mail->send();
    $emailSent = true;

}
catch (Exception $e) {
    $errorMsg = "Mailer Error: " . $mail->ErrorInfo;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Booking Confirmed</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-image: url(concert2.jpg);
      background-size: cover;
    }

    .message-box {
      background-color:rgba(130, 198, 235, 0.76);
      max-width: 600px;
      margin: auto;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 4px 4px 4px rgba(0, 0, 0, 0.57);
      text-align: center;
      margin-top: 90px;
    }

    h2 {
      color: #27ae60;
    }

    .code-box {
      margin-top: 15px;
      font-size: 18px;
      color: #333;
    }

    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="message-box">
    <?php if ($emailSent): ?>
      <h2>Booking Confirmed!</h2>
      <p>Thank you, <strong><?= htmlspecialchars($name) ?></strong>.</p>
      <p>Your booking for <strong><?= htmlspecialchars($event) ?></strong> has been confirmed.</p>
      <p><strong>Tickets:</strong> <?= htmlspecialchars($tickets) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>

      <div class="code-box">
        <p><strong>Booking Code:</strong> <?= $bookingCode ?></p>
        <p><strong>Seat Number(s):</strong> <?= implode(', ', $seatNumbers) ?></p>
      </div>
    <?php else: ?>
      <h2 class="error">Booking Failed</h2>
      <p>There was an error sending your email confirmation.</p>
      <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>
  </div>
</body>
</html>
