<?php
// Connect to MySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oleum";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
$fullname = $_POST["fullname"];
$Address1 = $_POST["Address1"];
$Address2 = $_POST["Address2"];
$city = $_POST["City"];
$state = $_POST["State"];
$zip = $_POST["Zipcode"];

// Insert data into the login table
$sql = "INSERT INTO ClientProfile (fullname, address1, address2, city, state, zip) VALUES ('$fullname', '$Address1','$Address2', '$city', '$state', '$zip')";
if ($conn->query($sql) === TRUE) {
  // Redirect to profile management page
  header("Location: ClientProfile.html");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
