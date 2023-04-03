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
$gallons_requested = $_POST["gallonsRequested"];
$delivery_address = $_POST["deliveryAddress"];
$delivery_date = $_POST["deliveryDate"];
$suggested_price = 1.70;
$total_amount_price = $_POST["totalAmountDue"];

// Insert data into the fuelquote table
$sql = "INSERT INTO FuelQuoteForm (gallonsRequested, deliveryAddress, deliveryDate, 1.70, totalAmountDue) VALUES ('$gallons_requested', '$delivery_address','$delivery_date', '$suggested_price', '$total_amount_due')";
if ($conn->query($sql) === TRUE) {
  // Redirect to profile management page
  header("Location: fuel_quote_form.html");
  exit();
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
