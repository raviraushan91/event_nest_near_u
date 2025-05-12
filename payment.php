<?php
session_start();

$price_per_ticket = 200;

// Save user input in session
$_SESSION['name'] = $_POST['name'] ?? '';
$_SESSION['email'] = $_POST['email'] ?? '';
$_SESSION['tickets'] = $_POST['no_of_people'] ?? 1;
$_SESSION['event'] = $_POST['event'] ?? '';

$total_price = $price_per_ticket * (int)$_SESSION['tickets'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment</title>
</head>
<body>
  <h2>Payment Page</h2>

  <p><strong>Name:</strong> <?= htmlspecialchars($_SESSION['name']) ?></p>
  <p><strong>Event:</strong> <?= htmlspecialchars($_SESSION['event']) ?></p>
  <p><strong>Tickets:</strong> <?= $_SESSION['tickets'] ?> × ₹<?= $price_per_ticket ?></p>
  <p><strong>Total Amount:</strong> ₹<?= $total_price ?></p>

  <form action="upi-handler.php" method="post">
    <label>Select Payment Mode:</label><br>
    <input type="radio" name="payment_mode" value="UPI" required> UPI<br>
    <input type="radio" name="payment_mode" value="Credit Card"> Credit Card<br>
    <input type="radio" name="payment_mode" value="Net Banking"> Net Banking<br>
    <input type="radio" name="payment_mode" value="Debit Card"> Debit Card<br><br>

    <input type="submit" value="Pay Now">
  </form>
</body>
</html>


<style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', sans-serif;
      background: url('concert2.jpg') no-repeat center center/cover;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      backdrop-filter: blur(4px);
    }

    .form-container {
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(12px);
      padding: 40px 30px;
      border-radius: 20px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.5);
      width: 100%;
      max-width: 500px;
      color: #fff;
      animation: fadeIn 0.8s ease;
    }

    h2 {
      text-align: center;
      margin-bottom: 25px;
      font-size: 1.8rem;
      color: #00e6ff;
    }

    .form-group {
      position: relative;
      margin-bottom: 25px;
    }

    .form-group input,
    .form-group select {
      width: 100%;
      padding: 12px 10px;
      background: transparent;
      border: 1px solid #00e6ff;
      border-radius: 10px;
      outline: none;
      color: skyblue;
      font-size: 15px;
    }

    .form-group label {
      position: absolute;
      top: 50%;
      left: 15px;
      transform: translateY(-50%);
      background-color: transparent;
      color: #ccc;
      font-size: 14px;
      transition: 0.3s;
      pointer-events: none;
      padding: 0 4px;
    }

    .form-group input:focus+label,
    .form-group input:not(:placeholder-shown)+label,
    .form-group select:focus+label {
      top: -10px;
      left: 10px;
      font-size: 12px;
      background-color: rgba(0, 0, 0, 0.6);
      color: #00e6ff;
    }

    .btn {
      width: 100%;
      padding: 14px;
      background: linear-gradient(135deg, #00ffc3, #00e6ff);
      border: none;
      border-radius: 10px;
      color: #000;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .btn:hover {
      background: linear-gradient(135deg, #00e6ff, #00ffc3);
      transform: scale(1.03);
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
        transform: scale(0.95);
      }

      to {
        opacity: 1;
        transform: scale(1);
      }
    }
  </style>