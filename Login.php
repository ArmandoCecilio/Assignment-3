<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oleum";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT * FROM login WHERE username='$username'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  echo "Username already exists.";
} else {
  $sql = "INSERT INTO login (username, password) VALUES ('$username', '$password')";
  if ($conn->query($sql) === TRUE) {
    header("Location: ClientProfile.html");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }
}

$conn->close();
