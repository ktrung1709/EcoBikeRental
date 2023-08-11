<?php
require_once 'StandardBike.php';


class TwinBike extends StandardBike {

   

    public function __construct($id, $barcode, $value, $charge) {
        parent::__construct($id, $barcode, $value, $charge);
        $this->saddle = 2;
        $this->rearSeat = 1;
        $this->pairOfPedals = 2;
        $this->deposit = $value / 10;
        // $this->feeCalculator = new RentingFeeForTwinBikeCalculator();
    }

    public function getBikeType() {
        return "Twin Bike";
    }
}
?>
