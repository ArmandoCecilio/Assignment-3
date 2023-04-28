function getSuggestedPrice($conn, $userId, $userState, $requestedGallons) {
    // Validate the user input for requested gallons
    if (!is_numeric($requestedGallons) || $requestedGallons <= 0) {
        throw new Exception('Invalid requested gallons value');
    }

    // Use a more accurate and updated current price for fuel
    $currentPrice = 1.75;

    // Use prepared statements to prevent SQL injection attacks
    $stmt = $conn->prepare("SELECT * FROM fuelquoteform WHERE member_ID = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check for errors with the database query
    if (!$result) {
        throw new Exception('Error with database query');
    }

    // Get the number of rows in the result set
    $count = $result->num_rows;

    $locationFactor = $userState == 'TX' ? 0.02 : 0.04;
    $rateHistoryFactor = $count > 0 ? 0.01 : 0.00;
    $gallonsRequestedFactor = $requestedGallons > 1000 ? 0.02 : 0.03;
    $companyProfitFactor = 0.1;
    $margin = $currentPrice * ($locationFactor - $rateHistoryFactor + $gallonsRequestedFactor + $companyProfitFactor);
  
    $suggestedPrice = $currentPrice + $margin;

    return $suggestedPrice;
}


