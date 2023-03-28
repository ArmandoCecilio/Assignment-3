<?php

$suggestedPricePerGallon = 10; // Set the suggested price per gallon to 10

if(isset($_POST['gallons']) && is_numeric($_POST['gallons'])) {
  // Check if the number of gallons is set and is a numeric value
  
  $gallonsRequested = $_POST['gallons'];
  $totalPrice = $gallonsRequested * $suggestedPricePerGallon; // Calculate the total price
  echo "The suggested price per gallon is $" . $suggestedPricePerGallon . ", and the total price for " . $gallonsRequested . " gallons is $" . $totalPrice . "."; // Display the results
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Suggested Price Calculator</title>
</head>
<body>
  <h1>Suggested Price Calculator</h1>
  <form method="post">
    <label for="gallons">Enter the number of gallons:</label>
    <input type="text" name="gallons" id="gallons" required>
    <br>
    <input type="submit" value="Calculate">
  </form>
</body>
</html>