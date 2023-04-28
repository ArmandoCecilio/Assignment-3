<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  require_once("connection.php");
  require_once("pricingmodule.php");
  $gallons=NULL;
  if(!isset($_POST['gallons']))
  {
    echo json_encode(("error: delivery date expected"));
    $conn->die();
  }
  $gallons=$_POST['gallons'];
  if(!isset($_POST['deliverydate']))
  {
    echo json_encode(("error: gallons expected"));
    $conn->close();
    die();
  }
  $deliverydate=$_POST['deliverydate'];
  
  session_start();

  $member_id = $_SESSION['id'];
  if($member_id)
  {
    $query="SELECT state FROM clientprofile WHERE member_ID='$member_id'";
    $result=$conn->query($query);
    if(mysqli_num_rows($result)!=1)
    {
      $conn->close();
      die();
    }
    $result=mysqli_fetch_row($result);
    $state=$result[0];
    $suggprice=getsugestedprice($conn, $member_id, $state, $gallons);
    $total=$gallons*$suggprice;
    $response= array('rate' => $suggprice, 'total'=> $total );
    echo json_encode($response);
  }
}
else{
    echo "Error.";
}

//header("Location: home_page.php?error=1");