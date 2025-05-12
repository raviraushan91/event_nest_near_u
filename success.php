<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

// Get session data
$name = $_SESSION['name'] ?? '';
$email = $_SESSION['email'] ?? '';
$tickets = $_SESSION['tickets'] ?? 1;
$event = $_SESSION['event'] ?? '';
$payment_mode = $_SESSION['payment_mode'] ?? 'Unknown';

// Generate Booking Code
function generateBookingCode() {
    return 'BK' . strtoupper(bin2hex(random_bytes(3)));
}

// Generate Seat Numbers
function generateSeatNumber() {
    $row = chr(rand(65, 68)); // A to D
    $number = rand(1, 20);
    return $row . $number;
}

// Booking details
$bookingCode = generateBookingCode();
$seatNumbers = [];

for ($i = 0; $i < (int)$tickets; $i++) {
    $seatNumbers[] = generateSeatNumber();
}

// Send confirmation email
$mail = new PHPMailer(true);
$emailSent = false;
$errorMsg = '';

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'ck667941@gmail.com';               // Your Gmail
    $mail->Password   = 'ohrj qcra pdkw nyrw';              // App password
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
        <p><strong>Payment Mode:</strong> $payment_mode</p>
        <p>Please show this email at the event gate.</p><br>
        <em>Event Nest by Chandan</em>
    ";

    $mail->send();
    $emailSent = true;

    // Insert ticket details into database
  $conn = new mysqli('localhost', 'root', 'Chandan123$456', 'eventnest_by_chandan');
    if ($conn->connect_error) {
        die("DB Connection failed: " . $conn->connect_error);
    }

    $seats = implode(', ', $seatNumbers);
    $stmt = $conn->prepare("INSERT INTO tickets (name, email, event, tickets, seat_numbers, booking_code, payment_mode) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssisss", $name, $email, $event, $tickets, $seats, $bookingCode, $payment_mode);
    $stmt->execute();
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    $errorMsg = "Mailer Error: " . $mail->ErrorInfo;
}
?>


<!DOCTYPE html>
<html>
<head>
  <title>Booking Confirmation</title>
  <style>
    body {
      font-family: Arial;
      padding: 20px;
      background-color: #eef;
    }
    .box {
      max-width: 600px;
      margin: auto;
      padding: 25px;
      background-color: white;
      border-radius: 10px;
      box-shadow: 0 0 10px gray;
    }
    h2 { color: green; }
    .error { color: red; }
  </style>
</head>
<body>
  <div class="box">
    <?php if ($emailSent): ?>
      <h2>Booking Confirmed!</h2>
      <p>Thank you, <strong><?= htmlspecialchars($name) ?></strong>.</p>
      <p>Your booking for <strong><?= htmlspecialchars($event) ?></strong> is successful.</p>
      <p><strong>Tickets:</strong> <?= htmlspecialchars($tickets) ?></p>
      <p><strong>Email:</strong> <?= htmlspecialchars($email) ?></p>
      <p><strong>Payment Mode:</strong> <?= htmlspecialchars($payment_mode) ?></p>
      <p><strong>Booking Code:</strong> <?= $bookingCode ?></p>
      <p><strong>Seat Numbers:</strong> <?= implode(', ', $seatNumbers) ?></p>
    <?php else: ?>
      <h2 class="error">Booking Failed</h2>
      <p>Could not send confirmation email.</p>
      <p class="error"><?= htmlspecialchars($errorMsg) ?></p>
    <?php endif; ?>
    <a href="home.php"> go to main page</a>
  </div>
</body>
</html>
