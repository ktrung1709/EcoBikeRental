<?php
require_once 'StandardElectricalBike.php';


class TwinElectricalBike extends StandardElectricalBike {

   
    public function __construct($id, $barcode, $value, $charge) {
        parent::__construct($id, $barcode, $value, $charge);
        $this->saddle = 1;
        $this->rearSeat = 1;
        $this->pairOfPedals = 1;
        $this->deposit = $value / 10;
        $this->battery = 100;
        $this->timeLeft = 360;
        $this->feeCalculator = new RentingFeeForTwinEBikeCalculator();
    }

    public function getBikeType() {
        return "Twin E-Bike";
    }
}
?>
