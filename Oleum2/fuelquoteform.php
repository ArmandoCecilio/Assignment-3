<link rel="stylesheet" type="text/css" href="clientprofile.css">
<nav class="navtop">
    <div>
        <title>Fuel Quote Form - Oleum</title>
        <h1>Oleum</h1>
        <a href="Home_Page.php"><i class="fas fa-home"></i>Home</a>
    </div>
</nav>
<?php
require_once("connection.php");
require_once("pricingmodule.php");

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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['gallons_requested']) && isset($_POST['delivery_date']) && isset($_POST['suggested_price'])) {
    
    $gallons_requested = $_POST['gallons_requested'];
    $delivery_date = $_POST['delivery_date'];
    $suggested_price = $_POST['suggested_price'];

    //$suggested_price = 0;

    $check1 = "SELECT state FROM clientprofile WHERE member_ID = '$member_id'";
    $result = mysqli_query($conn, $check1);
    $state="";
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $state = $row['state'];
        //echo $state;

       /* if ($state == "TX") {
            $suggested_price += 0.02;
        } else {
            $suggested_price += 0.04;
        }*/
    }

    //check if there is any tampering with the suggested price per gallon calculated from module.
    $me=0.00000001;
    $pricingvalue=getsugestedprice($conn, $member_id,$state,$gallons_requested);
    if($me<abs($suggested_price-$pricingvalue))
    {
      $conn->close();
      header("Location: home_page.php?error=$suggested_price.$pricingvalue");
      exit();
    }

/*
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
*/
    $total_amount_due = $gallons_requested * $suggested_price;
  
    $sql_insert = "INSERT INTO fuelquoteform (member_id, gallons_requested, delivery_date, suggested_price, total_amount_due) VALUES ('$member_id', '$gallons_requested', '$delivery_date', '$suggested_price', '$total_amount_due')";
    $result=$conn->query($sql_insert);
    $res = $conn->query('SELECT LAST_INSERT_ID()');//mysqli_query('SELECT LAST_INSERT_ID()');
    $ro = mysqli_fetch_array($res);
    $lastInsertId = $ro[0];
    if ($result === TRUE) {
      $gallons_requested=NULL;
      $delivery_date=NULL;
      $suggested_price=NULL;
      $total_amount_due=NULL;
      $_POST=Array();
      header("Location: redirect.php?success=$lastInsertId");
    } else {
      echo "Error submitting fuel quote form: " . $conn->error;
    }
  }
  else if(isset($_GET['success']))
  {
    $id=$_GET['success'];
    echo "Fuel quote $id submitted successfully!";
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

<form name='quoteform' id='quoteform' method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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

  <br><br><label for="suggested_price" style="display:none;"> Suggested Price/Gallon:*</label>
  <input type="number" id="suggested_price" name="suggested_price" step="0.01" value="" readonly>

  <br><br><label for="total_amount_due" style="display:none;">Total Amount Due:*</label>
  <input type="number" id="total_amount_due" name="total_amount_due" step="0.01" value="" readonly>
  <br><br><button id="getquote" name="getquote" value="GetQuote">Get Quote</button>
  <br><br><input id="Submit" type="submit" value="Submit">


</form>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" type="text/javascript">
</script>
<script>

  function handleSubmission(e) {
  e.preventDefault();
  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  //console.log(formData);
  var gallons=formProps.gallons_requested;
  var deliverydate=formProps.delivery_date;
  var suggestedprice=formProps.suggested_price;
  var total=formProps.total_amount_due;

  console.log(gallons,deliverydate,suggestedprice,total);
  if(gallons && delivery_date)
  {
    var quoteform=document.getElementById("quoteform");
    console.log(quoteform.action);
    if( gallons && deliverydate &&
     suggestedprice && total )
    {
      quoteform.submit();
      console.log("Random");
      //document.getElementById("quoteform").submit();
      quoteform.action='getpricing.php?';
    }
    else{
    $.ajax({
      url      : 'getpricing.php?',//note that this is setting the `url` property to the value of the `url` variable
      data     : {gallons:gallons, deliverydate:deliverydate},
      type     : 'post',
      success  : function(Result){
            console.log(Result);
            var result = $.parseJSON(Result);
            quoteform.suggested_price.labels[0].style='display:block';
            quoteform.total_amount_due.labels[0].style='display:block';
            quoteform.suggested_price.style='display:block;';
            quoteform.total_amount_due.style='display:block;';
            quoteform.suggested_price.value=result.rate;
            quoteform.total_amount_due.value=result.total;
            quoteform.Submit.style='display:block;';
            quoteform.getquote.style='display:none;';
            quoteform.action='fuelquoteform.php';
            //you can now access data like this:
            //myObj.Address_1
        }
    }
    );
  }
  }
  }


  function getQuote()
  {
    console.log("Called");
    var quoteform=document.getElementsByName('quoteform');
    var gallons=quoteform.gallons_requested;
    var deliverydate=quoteform.delivery_date;
    console.log(gallons);
    if(gallons && deliverydate)
    {
      console.log("Passed the variables");
      $.ajax({
      url      : 'pricingmodule.php?',//note that this is setting the `url` property to the value of the `url` variable
      data     : {gallons:gallons},
      type     : 'post',
      success  : function(Result){
            var result = $.parseJSON(Result);
            quoteform.suggested_price=result.rate;
            quoteform.total_amount_due=result.total;
            quoteform.Submit.style='display:block;';
            //you can now access data like this:
            //myObj.Address_1
        }
    }
    );
    }
  }
  const quoteForm = document.getElementById("quoteform");
  quoteForm.addEventListener("submit", handleSubmission);
</script>
<style>
#Submit, #suggested_price, #total_amount_due{
  display:none;
}
</style>