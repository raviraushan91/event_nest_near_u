<?php
session_start();
$email = $_SESSION['email'] ?? '';

  $conn = new mysqli('localhost', 'root', 'Chandan123$456', 'eventnest_by_chandan');

if ($conn->connect_error) {
  die("DB Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM tickets WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>My Ticket</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
      font-family: Arial;
      padding: 20px;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #ddd;
      padding: 8px;
    }

    th {
      background-color: #28a745;
      color: white;
    }
  </style>
  <style>
    body {
      background: #eee;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .ticket {
      display: flex;
      width: 900px;
      height: 250px;
      background: linear-gradient(to right, #e2ccb3 70%, #1e1e1e 70%);
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .left {
      width: 50px;
      background: #d9bfa5;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .barcode-vertical {
      width: 20px;
      height: 180px;
      background: repeating-linear-gradient(to right,
          #000,
          #000 2px,
          #fff 2px,
          #fff 4px);
    }

    .middle {
      flex-grow: 1;
      padding: 30px;
      background-image: url('https://www.transparenttextures.com/patterns/asfalt-dark.png');
      background-repeat: repeat;
      position: relative;
      color: #000;
    }

    .artist-name {
      font-size: 32px;
      margin: 0;
    }

    .event-type {
      font-size: 18px;
      margin-bottom: 20px;
    }

    .date-time,
    .venue {
      margin: 5px 0;
      font-size: 16px;
    }

    .info {
      display: flex;
      gap: 40px;
      margin-top: 20px;
      font-size: 14px;
    }

    .info div {
      text-align: center;
    }

    .right {
      width: 180px;
      color: #f3e1c7;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background: #1e1e1e;
      padding: 20px 10px;
    }

    .right-text {
      text-align: center;
    }

    .rotate-text {
      font-size: 12px;
      line-height: 1.4;
    }

    .rotate-text .artist {
      font-weight: bold;
      font-size: 16px;
    }

    .info-mini {
      display: flex;
      justify-content: space-around;
      font-size: 12px;
      margin-top: 10px;
    }

    .barcode-horizontal {
      height: 30px;
      width: 100%;
      background: repeating-linear-gradient(to right,
          #fff,
          #fff 2px,
          #000 2px,
          #000 4px);
      margin-top: 10px;
    }
  </style>
</head>

<body>
  <h2>My Booked Tickets</h2>

  <?php if ($result->num_rows > 0): ?>
    <table>
      <tr>
        <th>Event</th>
        <th>Tickets</th>
        <th>Seats</th>
        <th>Booking Code</th>
        <th>Payment Mode</th>
        <th>Booked At</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['event']) ?></td>
          <td><?= $row['tickets'] ?></td>
          <td><?= htmlspecialchars($row['seat_numbers']) ?></td>
          <td><?= $row['booking_code'] ?></td>
          <td><?= $row['payment_mode'] ?></td>
          <td><?= $row['created_at'] ?></td>
        </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>No tickets found for <?= htmlspecialchars($email) ?>.</p>
  <?php endif; ?>
  <div class="ticket">
    <div class="left">
      <div class="barcode-vertical"></div>
    </div>
    <div class="middle">
      <h1 class="artist-name">ARTIST NAME</h1>
      <p class="event-type">MUSIC CONCERT</p>
      <p class="date-time">20 JUNE / 19:00</p>
      <p class="venue">CONCERT AREA</p>
      <div class="info">
        <div><strong>ENTRANCE</strong><br>2</div>
        <div><strong>SECTOR</strong><br>B</div>
        <div><strong>ROW</strong><br>5</div>
        <div><strong>SEAT</strong><br>10</div>
      </div>
    </div>
    <div class="right">
      <div class="right-text">
        <div class="rotate-text">
          <span class="artist">ARTIST NAME</span><br>
          <span class="event">MUSIC CONCERT</span><br>
          <span>20 JUNE / 19:00</span><br>
          <span>CONCERT AREA</span>
        </div>
        <div class="info-mini">
          <span>2</span>
          <span>B</span>
          <span>5</span>
          <span>10</span>
        </div>
      </div>
      <div class="barcode-horizontal"></div>
    </div>
  </div>


</body>

</html>