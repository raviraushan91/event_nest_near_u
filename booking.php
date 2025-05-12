<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start();

$price_per_ticket = 200;
$step = 1;

if (isset($_POST['step1'])) {
  $_SESSION['name'] = $_POST['name'] ?? '';
  $_SESSION['email'] = $_POST['email'] ?? '';
  $_SESSION['event'] = $_POST['event'] ?? '';
  $_SESSION['tickets'] = $_POST['no_of_people'] ?? 1;
  $step = 2;
} elseif (isset($_POST['step2'])) {
  $_SESSION['payment_mode'] = $_POST['payment_mode'] ?? '';
  $step = 3;
} elseif (isset($_POST['step3'])) {
  $step = 4;
}

function generateBookingCode()
{
  return 'BK' . strtoupper(bin2hex(random_bytes(3)));
}

function generateSeatNumber()
{
  return chr(rand(65, 68)) . rand(1, 30);
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Book Tickets</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Segoe UI", sans-serif;
    }

    body {
      background: url('concert2.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
    }

    .container {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 20px;
      padding: 30px;
      width: 90%;
      max-width: 600px;
      backdrop-filter: blur(12px);
      box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
      animation: slideIn 1s ease;
      color: white;
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
      color: #fff;
      text-shadow: 1px 1px 2px #000;
    }

    label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    input[type="text"],
    input[type="email"],
    select {
      width: 100%;
      padding: 10px 15px;
      border-radius: 8px;
      border: none;
      margin-bottom: 15px;
      outline: none;
      background: rgba(255, 255, 255, 0.2);
      color: #fff;
      transition: all 0.3s ease;
    }

    input:focus,
    select:focus {
      background: rgba(255, 255, 255, 0.3);
      box-shadow: 0 0 5px #fff;
    }

    input[type="radio"] {
      margin-right: 8px;
    }

    button {
      width: 100%;
      padding: 12px;
      background: #00c6ff;
      background: linear-gradient(to right, #0072ff, #00c6ff);
      color: white;
      font-size: 16px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      transition: transform 0.2s, box-shadow 0.2s;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 5px 10px rgba(0, 198, 255, 0.5);
    }

    .confirmation-container {
      background: rgba(0, 0, 0, 0.8);
      padding: 30px;
      border-radius: 10px;
      max-width: 600px;
      margin: 20px auto;
      text-align: center;
      color: #fff;
    }

    .confirmation-container h2 {
      font-size: 30px;
      color: #28a745;
      margin-bottom: 15px;
    }

    a {
      display: block;
      margin-top: 30px;
      color: #00e6ff;
      text-decoration: none;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php if ($step === 1): ?>
      <h2>Step 1: Book Tickets</h2>
      <form method="post">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Event Name:</label>
        <input type="text" name="event" required>

        <label>Number of Tickets:</label>
        <select name="no_of_people" style="color: black;" required>
          <option value="" hidden>Select</option>
          <?php for ($i = 1; $i <= 10; $i++): ?>
            <option value="<?= $i ?>"><?= $i ?></option>
          <?php endfor; ?>
        </select>

        <button type="submit" name="step1">Continue to Payment</button>
      </form>

    <?php elseif ($step === 2): ?>
      <h2>Step 2: Payment</h2>
      <p><strong>Name:</strong> <?= $_SESSION['name'] ?></p>
      <p><strong>Event:</strong> <?= $_SESSION['event'] ?></p>
      <p><strong>Tickets:</strong> <?= $_SESSION['tickets'] ?> × ₹<?= $price_per_ticket ?></p>
      <p><strong>Total:</strong> ₹<?= ($_SESSION['tickets'] * $price_per_ticket) ?></p>

      <form method="post">
        <label>Select Payment Mode:</label>
        <input type="radio" name="payment_mode" value="UPI" required> UPI
        <input type="radio" name="payment_mode" value="Credit Card"> Credit Card
        <input type="radio" name="payment_mode" value="Net Banking"> Net Banking
        <input type="radio" name="payment_mode" value="Debit Card"> Debit Card

        <button type="submit" name="step2">Pay Now</button>
      </form>

    <?php elseif ($step === 3): ?>
      <h2>Step 3: Processing Payment</h2>
      <?php if ($_SESSION['payment_mode'] === 'UPI'): ?>
        <p>UPI notification sent to your phone. Please approve.</p>
      <?php else: ?>
        <p>Redirecting to <?= $_SESSION['payment_mode'] ?> gateway...</p>
      <?php endif; ?>
      <form method="post">
        <button type="submit" name="step3">Simulate Payment Success</button>
      </form>

    <?php elseif ($step === 4): ?>
      <?php
      $name = $_SESSION['name'];
      $email = $_SESSION['email'];
      $tickets = $_SESSION['tickets'];
      $event = $_SESSION['event'];
      $payment_mode = $_SESSION['payment_mode'];

      $bookingCode = generateBookingCode();
      $seatNumbers = [];
      for ($i = 0; $i < (int)$tickets; $i++) {
        $seatNumbers[] = generateSeatNumber();
      }

      $mail = new PHPMailer(true);
      $emailSent = false;
      $errorMsg = '';

      try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'ck667941@gmail.com';
        $mail->Password   = 'ohrj qcra pdkw nyrw';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('ck667941@gmail.com', 'EventNest by Chandan');
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

      <div class="confirmation-container">
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
          <h2 style="color:red;">Booking Failed</h2>
          <p>Could not send confirmation email.</p>
          <p style="color:red;"><?= htmlspecialchars($errorMsg) ?></p>
        <?php endif; ?>
        <a href="home.php">Go to Main Page</a>
      </div>
    <?php endif; ?>
  </div>
</body>

</html>