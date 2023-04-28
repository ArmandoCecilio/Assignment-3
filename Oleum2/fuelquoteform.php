<link rel="stylesheet" type="text/css" href="clientprofile.css">
<nav class="navtop">
    <div>
        <title>Fuel Quote Form - Oleum</title>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gallons_requested = $_POST['gallons_requested'];
    $delivery_date = $_POST['delivery_date'];
    $suggested_price = $_POST['suggested_price'];

    $suggested_price = 0;

    $check1 = "SELECT state FROM clientprofile WHERE member_ID = '$member_id'";
    $result = mysqli_query($conn, $check1);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $state = $row['state'];
        if ($state == "TX") {
            $suggested_price += 0.02;
        } else {
            $suggested_price += 0.04;
        }
    }


    $check2 = "SELECT member_ID FROM fuelquoteform WHERE member_ID = '$member_id'";
    $result2 = mysqli_query($conn, $check2);

    if (mysqli_num_rows($result2) > 0) {
      $row2 = mysqli_fetch_assoc($result2);
      $history = $row2['member_ID'];
      if ($history) {
        $suggested_price -= 0.01;
      } else {
        $suggested_price += 0.00; 
      }
    }

    if ($gallons_requested > 1000) {
      $suggested_price += 0.02;
    } else {
      $suggested_price += 0.03;
    }

    $suggested_price = $suggested_price + 0.10;

    $suggested_price = 1.5 * $suggested_price;

    $suggested_price = 1.5 + $suggested_price;

    $total_amount_due = $gallons_requested * $suggested_price;
  
    $sql_insert = "INSERT INTO fuelquoteform (member_id, gallons_requested, delivery_date, suggested_price, total_amount_due) VALUES ('$member_id', '$gallons_requested', '$delivery_date', '$suggested_price', '$total_amount_due')";
  
    if ($conn->query($sql_insert) === TRUE) {
      echo "Fuel quote form submitted successfully!";
    } else {
      echo "Error submitting fuel quote form: " . $conn->error;
    }
  }


  ?>

<style>
  form {
    display: flex;
    flex-direction: column;
    justify-content: center;
    max-width: 400px;
    margin: 0 auto;
    margin-top:50px;
    margin-bottom:50px;
  }
</style>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <?php
  $check1 = "SELECT address_1 FROM clientprofile WHERE member_ID = '$member_id'";
  $result_form = $conn->query($check1);

  $current_address_1 = "";

  if ($result_form->num_rows > 0) {
    $row_form = $result_form->fetch_assoc();
    $current_address_1 = $row_form['address_1'];
  }
    
  echo '<label for="address_1">Address Line 1:*</label>';
  echo '<input type="text" id="address_1" name="address_1" value="' . $current_address_1 . '" readonly>';   
  ?>

  <br><br><label for="gallons_requested">Gallons Requested:*</label>
  <input type="number" id="gallons_requested" name="gallons_requested" required> 

  <br><br><label for="delivery_date">Delivery Date:*</label>
  <input type="date" id="delivery_date" name="delivery_date" required> 

  <br><br><label for="suggested_price">Suggested Price/Gallon:*</label>
  <input type="number" id="suggested_price" name="suggested_price" step="0.01" value="<?php echo $suggested_price; ?>" readonly>

  <br><br><label for="total_amount_due">Total Amount Due:*</label>
  <input type="number" id="total_amount_due" name="total_amount_due" step="0.01" value="<?php echo $total_amount_due; ?>" readonly>

  <br><br><input type="submit" value="Submit">


</form>
