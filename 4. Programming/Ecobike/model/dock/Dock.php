<?php

require_once 'model/bike/Bike.php';

class Dock {
    private $name;
    private $location;
    private $capacity;
    private $numberOfAvailableBike;
    private $id;
    private $imageURL;
    private $bikeList;

    public function __construct($id, $name, $location, $capacity, $imageURL) {
        $this->id = $id;
        $this->name = $name;
        $this->location = $location;
        $this->capacity = $capacity;
        $this->imageURL = $imageURL;
        $this->bikeList = array();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setLocation($location) {
        $this->location = $location;
    }

    public function getCapacity() {
        return $this->capacity;
    }

    public function setCapacity($capacity) {
        $this->capacity = $capacity;
    }

    public function getNumberOfAvailableBike() {
        return $this->numberOfAvailableBike;
    }

    public function setNumberOfAvailableBike($numberOfAvailableBike) {
        $this->numberOfAvailableBike = $numberOfAvailableBike;
    }

    public function getImageURL() {
        return $this->imageURL;
    }

    public function setImageURL($imageURL) {
        $this->imageURL = $imageURL;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getBikeList() {
        return $this->bikeList;
    }

    public function addBike($bike) {
        $this->bikeList[] = $bike;
        $bike->setDock($this);
        $this->numberOfAvailableBike = count($this->bikeList);
    }

    public function removeBike($bike) {
        $index = array_search($bike, $this->bikeList, true);
        if ($index !== false) {
            unset($this->bikeList[$index]);
            $bike->setDock(null);
            $this->numberOfAvailableBike = count($this->bikeList);
        }
    }

    public function clearBikeList() {
        $this->bikeList = array();
    }

    public function addListOfBikes($list) {
        $this->bikeList = array_merge($this->bikeList, $list);
    }

    public function equals($obj) {
        if ($obj instanceof Dock) {
            $dock = $obj;
            return $dock->getId() === $this->id;
        }
        return false;
    }
}
