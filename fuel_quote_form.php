<?php

class FuelQuote {
  private $gallonsRequested;
  private $deliveryAddress;
  private $deliveryDate;
  private $suggestedPricePerGallon;

  public function __construct($gallonsRequested, $deliveryAddress, $deliveryDate, $suggestedPricePerGallon) {
    $this->gallonsRequested = $gallonsRequested;
    $this->deliveryAddress = $deliveryAddress;
    $this->deliveryDate = $deliveryDate;
    $this->suggestedPricePerGallon = $suggestedPricePerGallon;
  }

  public function calculateTotalAmountDue() {
    return $this->gallonsRequested * $this->suggestedPricePerGallon;
  }

  public function setGallonsRequested($gallonsRequested) {
    $this->gallonsRequested = $gallonsRequested;
  }

  public function setDeliveryAddress($deliveryAddress) {
    $this->deliveryAddress = $deliveryAddress;
  }

  public function setDeliveryDate($deliveryDate) {
    $this->deliveryDate = $deliveryDate;
  }

  public function setSuggestedPricePerGallon($suggestedPricePerGallon) {
    $this->suggestedPricePerGallon = $suggestedPricePerGallon;
  }

  public function getGallonsRequested() {
    return $this->gallonsRequested;
  }

  public function getDeliveryAddress() {
    return $this->deliveryAddress;
  }

  public function getDeliveryDate() {
    return $this->deliveryDate;
  }

  public function getSuggestedPricePerGallon() {
    return $this->suggestedPricePerGallon;
  }
}

if (!isset($_SERVER['REQUEST_METHOD'])) {
  $_SERVER['REQUEST_METHOD'] = 'POST';
}
// Get form inputs
$gallons_requested = isset($_POST['gallonsRequested']) ? $_POST['gallonsRequested'] : null;
$deliveryAddress = isset($_POST['deliveryAddress']) ? $_POST['deliveryAddress'] : null;
$deliveryDate = isset($_POST['deliveryDate']) ? $_POST['deliveryDate'] : null;
$suggestedPricePerGallon = 1.50; // This value can be changed as needed

// Create new FuelQuote object
$fuelQuote = new FuelQuote($gallons_requested, $deliveryAddress, $deliveryDate, $suggestedPricePerGallon);

// Calculate total amount due
$totalAmountDue = $fuelQuote->calculateTotalAmountDue();

?>