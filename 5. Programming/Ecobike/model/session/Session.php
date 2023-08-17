<?php

require 'model/bike/Bike.php';
require 'model/payment/paymentCard/creditCard/CreditCard.php';
require 'model/payment/transaction/PaymentTransaction.php';
require 'utils/Ultis.php';

class Session {

    private $id;
    private $bike;
    private $card;
    private $startTime;
    private $endTime;
    private $lastResumeTime;
    private $lastRentTimeBeforeLock = 0;
    private $active;
    private $rentTransaction;
    private $returnTransaction;

    public function __construct(Bike $bike, CreditCard $card, PaymentTransaction $rentTransaction) {
        $this->bike = $bike;
        $this->card = $card;
        $this->rentTransaction = $rentTransaction;
        $this->startTime = new \DateTime();
        $this->lastResumeTime = $this->startTime;
    }

    // (getters and setters)

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getBike() {
        return $this->bike;
    }

    public function setBike($bike) {
        $this->bike = $bike;
    }

    public function getCard() {
        return $this->card;
    }

    public function setCard($card) {
        $this->card = $card;
    }

    public function getStartTime() {
        return $this->startTime;
    }

    public function setStartTime($startTime) {
        $this->startTime = $startTime;
    }

    public function getEndTime() {
        return $this->endTime;
    }

    public function setEndTime($endTime) {
        $this->endTime = $endTime;
    }

    public function getLastResumeTime() {
        return $this->lastResumeTime;
    }

    public function setLastResumeTime($lastResumeTime) {
        $this->lastResumeTime = $lastResumeTime;
    }

    public function getLastRentTimeBeforeLock() {
        return $this->lastRentTimeBeforeLock;
    }

    public function setLastRentTimeBeforeLock($lastRentTimeBeforeLock) {
        $this->lastRentTimeBeforeLock = $lastRentTimeBeforeLock;
    }

    public function isActive() {
        return $this->active;
    }

    public function setActive($active) {
        $this->active = $active;
    }

    public function getRentTransaction() {
        return $this->rentTransaction;
    }

    public function getReturnTransaction() {
        return $this->returnTransaction;
    }

    public function setReturnTransaction($returnTransaction) {
        $this->returnTransaction = $returnTransaction;
    }



    public function getSessionInfo() {
        $info = array(
            "bike" => $this->bike->getBarcode(),
            "startTime" => $this->startTime->format(Utils::DATE_FORMATER),
            "endTime" => $this->endTime->format(Utils::DATE_FORMATER)
        );
        return $info;
    }

    public function getSessionLength() {
        $now = new DateTime();
        if ($this->active && $this->getEndTime() === null) {
            $difference = $now->diff($this->lastResumeTime);
            return $this->lastRentTimeBeforeLock + $difference->format('%s');
        } else if (!$this->active && $this->getEndTime() === null) {
            return $this->lastRentTimeBeforeLock;
        } else {
            $difference = $this->endTime->diff($this->lastResumeTime);
            return $this->lastRentTimeBeforeLock + $difference->format('%s');
        }
    }

    public function equals($o) {
        if ($this === $o) return true;
        if ($o === null || get_class($this) !== get_class($o)) return false;
        $session = $o;
        return $this->bike === $session->bike &&
                $this->card === $session->card &&
                $this->startTime === $session->startTime;
    }
}