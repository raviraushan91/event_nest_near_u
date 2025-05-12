<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
  $full_name = $_POST['full_name'];
  $email_address = $_POST['email'];
  $phone_number = $_POST['phone'];
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

  // File upload handling
  $photo_name = '';
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
      mkdir($upload_dir, 0755, true); // Create uploads folder if not exists
    }
    $photo_tmp = $_FILES['photo']['tmp_name'];
    $photo_name = basename($_FILES['photo']['name']);
    $target_file = $upload_dir . $photo_name;

    move_uploaded_file($photo_tmp, $target_file);
  }

  // Database connection
  $conn = new mysqli('localhost', 'root', 'Chandan123$456', 'eventnest_by_chandan');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  // Prepare and execute insert query
  $sql = $conn->prepare("INSERT INTO registration (full_name, email_address, phone_number, username, password, photo) VALUES (?, ?, ?, ?, ?, ?)");
  if (!$sql) {
    die("Error preparing statement: " . $conn->error);
  }

  $sql->bind_param("ssssss", $full_name, $email_address, $phone_number, $username, $password, $photo_name);

  if ($sql->execute()) {
    $sql->close();
    $conn->close();
    header('Location: home.php');
    exit();
  } else {
    echo "Error: " . $sql->error;
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Event Registration</title>
  <link rel="stylesheet" href="register.css" />
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <h1>Welcome to My Event Management System</h1>
      <p>Register to create an account. Enjoy your day 😊</p>
    </div>

    <div class="form-container">
      <h2>Event Registration Form</h2>
      <form method="post"  enctype="multipart/form-data">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="full_name" required />

        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" required />

        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required />

        <label for="username">Username</label>
        <input type="text" id="username" name="username" required />

        <label for="password">Create a Password</label>
        <input type="password" id="password" name="password" required />

        <label for="photo">Upload a Photo</label>
        <input type="file" id="photo" name="photo" accept="image/*" />

        <button type="submit" name="submit">Register</button>

        <div class="login-redirect">
          <span>Already have an account?</span>
          <a href="login.php" class="login-button">Login</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
