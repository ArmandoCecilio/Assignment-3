
<link rel="stylesheet" type="text/css" href="clientprofile.css">
<nav class="navtop">
    <div>
        <title>Client Profile - Oleum</title>
        <h1>Oleum</h1>
        <a href="Home_Page.php"><i class="fas fa-home"></i>Home</a>
    </div>
</nav>
<?php
require_once("connection.php");
/*$servername = "localhost";
$username = "root";
$password = "Decon_0213";
$dbname = "mydb";
$conn = new mysqli($servername, $username, $password, $dbname);
*/
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

  $full_name = $_POST['full_name'];
  $address_1 = $_POST['address_1'];
  $address_2 = $_POST['address_2'];
  $city = $_POST['city'];
  $state = $_POST['state'];
  $zipcode = $_POST['zipcode'];



  $sql_check = "SELECT * FROM clientprofile WHERE member_ID='$member_id'";
  $result_check = $conn->query($sql_check);

  if ($result_check->num_rows > 0) {
    $sql_update = "UPDATE clientprofile SET  full_name='$full_name', address_1='$address_1', address_2='$address_2', city='$city', state='$state', zipcode='$zipcode' WHERE member_ID='$member_id'";
    
    if ($conn->query($sql_update) === TRUE) {
      echo "Client Profile updated successfully!";
    } else {
      echo "Error updating Client Profile: " . $conn->error;
    }
  } else {
    $sql_insert = "INSERT INTO clientprofile (member_ID, full_name, address_1, address_2, city, state, zipcode) VALUES ('$member_id', '$full_name', '$address_1', '$address_2', '$city', '$state', '$zipcode')";
  
    if ($conn->query($sql_insert) === TRUE) {
      echo "Client Profile assigned successfully!";
    } else {
      echo "Error assigning Client Profile: " . $conn->error;
    }
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
  $check1 = "SELECT full_name, address_1, address_2, city, state, zipcode FROM clientprofile WHERE member_ID = '$member_id'";
  $result_form = $conn->query($check1);

  $current_full_name = "";
  $current_address_1 = "";
  $current_address_2 = "";
  $current_city = "";
  $current_state = "";
  $current_zipcode = "";

  if ($result_form->num_rows > 0) {
    $row_form = $result_form->fetch_assoc();
    $current_full_name = $row_form['full_name'];
    $current_address_1 = $row_form['address_1'];
    $current_address_2 = $row_form['address_2'];
    $current_city = $row_form['city'];
    $current_state = $row_form['state'];
    $current_zipcode = $row_form['zipcode'];
  }
  
  echo '<label for="full_name">Full Name:*</label>';
  echo '<input type="text" id="full_name" name="full_name" value="' . $current_full_name . '" required>';
    
  echo '<br><br><label for="address_1">Address Line 1:*</label>';
  echo '<input type="text" id="address_1" name="address_1" value="' . $current_address_1 . '" required>';
    
  echo '<br><br><label for="address_2">Address Line 2:</label>';
  echo '<input type="text" id="address_2" name="address_2" value="' . $current_address_2 . '">';
    
  echo '<br><br><label for="city">City:*</label>';
  echo '<input type="text" id="city" name="city" value="' . $current_city . '" required>';
    
  echo '<br><br><label for="state">State:*</label>';
  echo '<select id="state" name="state" required>';
  echo '<option value="">-- Select a state --</option>';
  $states = array('AL','AK','AZ','AR','CA','CO','CT','DE','FL','GA','HI','ID','IL','IN','IA','KS','KY','LA','ME','MD','MA','MI','MN','MS','MO','MT','NE','NV','NH','NJ','NM','NY','NC','ND','OH','OK','OR','PA','RI','SC','SD','TN','TX','UT','VT','VA','WA','WV','WI','WY');
  foreach($states as $state) {
    echo '<option value="' . $state . '"';
    if($state == $current_state) {
      echo ' selected';
    }
    echo '>' . $state . '</option>';
  }
  echo '</select>';
  
  echo '<br><br><label for="zipcode">Zipcode:*</label>';
  echo '<input type="text" id="zipcode" name="zipcode" value="' . $current_zipcode . '" required minlength="5" maxlength="9" title="Please enter a valid zipcode from 5 - 9 digits">';
    
  ?>
  <br><br>

  <input type="submit" value="Submit">
</form>