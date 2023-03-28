<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Oleum - Fuel Quote Form</title>
        <link rel="stylesheet" type="text/css" href="fuel_quote_form.css">
        <link rel="shortcut icon" type="image/x-icon" href="logo.ico">
    </head>
    <body>
        <div class = "navbar">
            <a href = "quotehistory.html">Quote History</a>
            <a href = "ClientProfile.html">Client Profile</a>
            <a class = "active" href = "fuel_quote_form.html">Fuel Quote Form</a>
            <a href = "Login.html">Log Out</a>
        </div>
        <div class = "box1">
            <!--Form-->
            <form action = "" method = "post">
            <!--Gallons Requested-->
            <label for = "gallonsRequested">Gallons Requested:</label>
            <input type = "number" id = "gallonsRequested" name = "gallonsRequested" required><br>

            <!--Delivery Address-->
            <label for = "deliveryAddress">Delivery Address:</label>
            <input type = "text" id = "deliveryAddress" name = "deliveryAddress" required><br>

            <!--Delivery Date-->
            <label for = "deliveryDate">Delivery Date:</label>
            <input type = "date" id = "deliveryDate" name = "deliveryDate" required><br>

            <!--Suggested Price / Gallon-->
            <label for = "suggestedPrice/Gallon">Suggested Price / Gallon:</label>
            <?php
                $suggestedPricePerGallon = 10;
                if(isset($_POST['gallonsRequested'])) {
                    $gallonsRequested = $_POST['gallonsRequested'];
                    $suggestedPricePerGallon = $suggestedPricePerGallon;
                    if($gallonsRequested > 1000) {
                        $suggestedPricePerGallon;
                    }
                    else {
                        $suggestedPricePerGallon;
                    }
                    echo "<input type='number' id='suggestedPrice/Gallon' name='suggestedPrice/Gallon' value='$suggestedPricePerGallon' readonly><br>";
                }
                else {
                    echo "<input type='number' id='suggestedPrice/Gallon' name='suggestedPrice/Gallon' value='$suggestedPricePerGallon' readonly><br>";
                }
            ?>
            <label for = "totalAmountDue">Total Amount Due:</label>
            <?php
                if(isset($_POST['gallonsRequested'])) {
                    $gallonsRequested = $_POST['gallonsRequested'];
                    $totalAmountDue = $gallonsRequested * $suggestedPricePerGallon;
                    echo "<input type='number' id='totalAmountDue' name='totalAmountDue' value='$totalAmountDue' readonly><br>";
                }
                else {
                    echo "<input type='number' id='totalAmountDue' name='totalAmountDue' readonly><br>";
                }
            ?>
            <input type = "submit" value = "Submit">
            </form>
        </div>
    </body>
</html>

<style>
  * {
    box-sizing: border-box
  }

  body {
    font-family: Arial, Helvetica, sans-serif;
  }

  .navbar {
    width: 100%;
    background-color: #555;
    overflow: auto;
  }

  .navbar a {
    float: left;
    padding: 12px;
    color: white;
    text-decoration: none;
    font-size: 17px;
    width: 25%;
    text-align: center;
  }

  .navbar a:hover {
    background-color: #000;
  }

  .navbar a.active {
    background-color: #2680eb;
  }

  @media screen and (max-width: 500px) {
    .navbar a {
      float: none;
      display: block;
      width: 100%;
      text-align: left;
    }
  }
</style>