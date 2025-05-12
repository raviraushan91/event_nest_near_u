<?php
  $conn = new mysqli('localhost', 'root', 'Chandan123$456', 'eventnest_by_chandan');
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>