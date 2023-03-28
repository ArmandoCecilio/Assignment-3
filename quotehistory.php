<?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get gallons requested and delivery date from form data
        $gallonsRequested = $_POST["gallonsRequested"];
        $deliveryDate = $_POST["deliveryDate"];

        // Generate random suggested price per gallon and total amount due
        $suggestedPricePerGallon = rand(1, 3);
        $totalAmountDue = $gallonsRequested * $suggestedPricePerGallon;

        // Set dummy delivery address
        $deliveryAddress = "123 Main St, Anytown, USA";

        // Print output
        echo "<p>Suggested Price / Gallon: $" . $suggestedPricePerGallon . "</p>";
        echo "<p>Total Amount Due: $" . $totalAmountDue . "</p>";
        echo "<p>Delivery Address: " . $deliveryAddress . "</p>";
        echo "<p>Delivery Date: " . $deliveryDate . "</p>";
    }
?>