<?php

require_once 'fuel_quote_form.php';

use PHPUnit\Framework\TestCase;

class FuelQuoteTest extends TestCase {

    /**
    * @covers FuelQuote
    */
    public function testCalculateTotalAmountDue() {
        $fuelQuote = new FuelQuote(100, '123 Main St', '2023-05-01', 1.50);
        $this->assertEquals(150.00, $fuelQuote->calculateTotalAmountDue());
        
        $fuelQuote->setGallonsRequested(200);
        $fuelQuote->setSuggestedPricePerGallon(1.75);
        $this->assertEquals(350.00, $fuelQuote->calculateTotalAmountDue());
    }

}
