<?php
//Need to get Logged In UserInformation.
$userid=$_SESSION['user_id'];
if(!$userid)
{
    echo  "User Is Not LoggedIn";
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "oleum";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data
// Insert data into the login table
$sql = "SELECT * fuelquote WHERE userid= $userid";
$result = $conn->query($sql);

    if ($result->num_rows > 0) {
//Insert the Whole Quotehistory.html here
echo `
<!DOCTYPE html>
<html>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
<head>
	<title>Oleum - Quote History</title>
	<link rel="stylesheet" type="text/css" href="quotehistory.css">
    <link rel="shortcut icon" type="image/x-icon" href="logo.ico" />
</head>
<body>
	<div class="navbar">
        <a class="active" href="quotehistory.html">Quote History</a> 
        <a href="ClientProfile.html">Client Profile</a> 
        <a href="fuel_quote_form.html">Fuel Quote Form</a> 
        <a href="Login.html">Log Out</a>
    </div>

      <!--Form-->
      <div class="container1">
        <ul class="responsive-table">
          <li class="table-header" style="margin-top:75px">
            <div class="col col-1">Gallons Requested</div>
            <div class="col col-2">Delivery Adress</div>
            <div class="col col-3">Delivery Date</div>
            <div class="col col-4">Price Per Gallon</div>
            <div class="col col-5">Total Amount Due</div>
          </li>
          `;
          while($row = $result->fetch_assoc()){
            echo   `
            <div class="col col-1" data-label="Gallons Requested">$row["gallons_requested"]</div>
            <div class="col col-2" data-label="Delivery Adress"> $row["delivery_address"]</div>
            <div class="col col-3" data-label="Delivery Date">$row["delivery_date"]</div>
            <div class="col col-4" data-label="Price Per Gallon">$row["suggested_price"]</div>
            <div class="col col-5" data-label="Total Amount Due">$row["total_amount_due"]</div>
          </li>
          `;
          }
          echo `
        </ul>
      </div>
</body>
</html>`;
    } 
    else {
          echo "No records has been found";
    }
$conn->close()
