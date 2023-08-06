<?php
require_once 'Bike.php';


class StandardBike extends Bike {

  

    public function __construct($id, $barcode, $value, $charge) {
        $this->id = $id;
        $this->barcode = $barcode;
        $this->saddle = 1;
        $this->rearSeat = 1;
        $this->pairOfPedals = 1;
        $this->value = $value;
        $this->deposit = $value / 10;
        $this->feeCalculator = new RentingFeeForStandardBikeCalculator();
    }

    public function getBikeType() {
        return "Standard Bike";
    }
}
?>
