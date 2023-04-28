<link rel="stylesheet" type="text/css" href="clientprofile.css">
<nav class="navtop">
    <div>
        <title>Fuel Quote History - Oleum</title>
        <h1>Oleum</h1>
        <a href="Home_Page.php"><i class="fas fa-home"></i>Home</a>
    </div>
</nav>
<?php
$servername = "localhost";
$username = "root";
$password = "Decon_0213";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: Login_Member.php');
	exit;
}

$member_id = $_SESSION['id'];
$sql = "SELECT * FROM member WHERE member_ID = '$member_id'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
  echo "Error: member with ID $member_id does not exist";
  exit;
}

$sql_forms = "SELECT * FROM fuelquoteform WHERE member_id = '$member_id'";
$result_forms = $conn->query($sql_forms);

if ($result_forms->num_rows > 0) {
  echo "<table>";
  echo "<tr><th>Form ID</th><th>Gallons Requested</th><th>Delivery Date</th><th>Suggested Price/Gallon</th><th>Total Amount Due</th></tr>";
  while($row_forms = $result_forms->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row_forms["quote_id"] . "</td>";
    echo "<td>" . $row_forms["gallons_requested"] . "</td>";
    echo "<td>" . $row_forms["delivery_date"] . "</td>";
    echo "<td>" . $row_forms["suggested_price"] . "</td>";
    echo "<td>" . $row_forms["total_amount_due"] . "</td>";
    echo "</tr>";
  }
  echo "</table>";
} else {
  echo "You have no submitted fuel quote forms";
}

$conn->close();
?>