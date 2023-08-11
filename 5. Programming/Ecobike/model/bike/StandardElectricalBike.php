<?php
require_once 'Bike.php';


class StandardElectricalBike extends Bike {
    protected $battery;
    protected $timeLeft;
    protected $charge = 20000;

   

    public function __construct($id, $barcode, $value, $charge) {
        $this->id = $id;
        $this->barcode = $barcode;
        $this->saddle = 1;
        $this->rearSeat = 1;
        $this->pairOfPedals = 1;
        $this->value = $value;
        $this->deposit = $value / 10;
        $this->battery = 100;
        $this->timeLeft = 360;
        // $this->feeCalculator = new RentingFeeForEBikeCalculator();
    }

    public function getBattery() { return $this->battery; }

    public function setBattery($battery) { $this->battery = $battery; }

    public function getCharge() {
        return $this->charge;
    }

    public function getTimeLeft() { return $this->timeLeft; }

    public function setTimeLeft($timeLeft) { $this->timeLeft = $timeLeft; }

    public function getBikeType() {
        return "E-Bike";
    }
}
?>
