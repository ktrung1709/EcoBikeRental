<?php

require_once 'model/dock/Dock.php'; 
require_once 'BikeManager.php'; 

class Bike {
    protected $id;
    protected $barcode;
    protected $saddle;
    protected $pairOfPedals;
    protected $rearSeat;
    protected $dock;
    protected $dockId;
    protected $value;
    protected $deposit;
    protected $charge = 10000;
    protected $imageURL;
    protected $feeCalculator;

    public function __construct( $barcode, $value, $charge) {
        $this->barcode = $barcode;
        $this->saddle = 1;
        $this->rearSeat = 1;
        $this->pairOfPedals = 1;
        $this->value = $value;
        $this->deposit = $value / 10;
        // $this->charge = $charge;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getId() {
        return $this->id;
    }

    public function setBarcode($barcode) {
        $this->barcode = $barcode;
    }

    public function getBarcode() {
        return $this->barcode;
    }

    public function setSaddle($saddle) {
        $this->saddle = $saddle;
    }

    public function getSaddle() {
        return $this->saddle;
    }

    public function setRearSeat($rearSeat) {
        $this->rearSeat = $rearSeat;
    }

    public function getRearSeat() {
        return $this->rearSeat;
    }

    public function setPairOfPedals($pairOfPedals) {
        $this->pairOfPedals = $pairOfPedals;
    }

    public function getPairOfPedals() {
        return $this->pairOfPedals;
    }

    public function setDock($dock) {
        $this->dock = $dock;
    }

    public function getDock() {
        return $this->dock;
    }

    public function setDockId($dockId) {
        $this->dockId = $dockId;
    }

    public function getDockId() {
        return $this->dockId;
    }

    public function setValue($value) {
        $this->value = $value;
    }

    public function getValue() {
        return $this->value;
    }

    public function setDeposit($deposit) {
        $this->deposit = $deposit;
    }

    public function getDeposit() {
        return $this->deposit;
    }

    public function getCharge() {
        return $this->charge;
    }

    // public function setCharge($charge) {
    //     $this->charge = $charge;
    // }

    public function setImageURL($imageURL) {
        $this->imageURL = $imageURL;
    }

    public function getImageURL() {
        return $this->imageURL;
    }

    public function getBikeType() {
        return "Bike";
    }

    public function equals($obj) {
        if ($obj instanceof Bike) {
            $bike = $obj;
            return $bike->getId() === $this->id;
        }
        return false;
    }

    public function getFeeCalculator() {
        return $this->feeCalculator;
    }

    public function takeBikeOutOfDock() {
        $this->dock->removeBike($this);
        BikeManager::getInstance()->updateDockOfBike($this, "");
    }

    public function putBikeInDock($dock) {
        $dock->addBike($this);
        BikeManager::getInstance()->updateDockOfBike($this, $dock->getId());
    }
}

$bike = new Bike(123456, 100, 10000);
$bike->setId("bike-123");
$bike->setImageURL("path/to/image.jpg");

