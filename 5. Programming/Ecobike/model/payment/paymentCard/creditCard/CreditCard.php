<?php

require_once 'model/payment/paymentCard/PaymentCard.php';

/**
 * Model for credit card
 *
 * Class CreditCard
 * @package model\payment\paymentCard\creditCard
 */
class CreditCard extends PaymentCard
{
    private $id;
    private $cardNum;
    private $cardOwner;
    private $securityCode;
    private $expDate;

    public function __construct($cardNum, $cardOwner, $securityCode, $expDate, $id = null)
    {
        $this->id = $id;
        $this->cardNum = $cardNum;
        $this->cardOwner = $cardOwner;
        $this->securityCode = $securityCode;
        $this->expDate = $expDate;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setCardNum($cardNum)
    {
        $this->cardNum = $cardNum;
    }

    public function setCardOwner($cardOwner)
    {
        $this->cardOwner = $cardOwner;
    }

    public function setExpDate($expDate)
    {
        $this->expDate = $expDate;
    }

    public function getCardNum()
    {
        return $this->cardNum;
    }

    public function getCardOwner()
    {
        return $this->cardOwner;
    }

    public function getSecurityCode()
    {
        return $this->securityCode;
    }

    public function getExpDate()
    {
        return $this->expDate;
    }

    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;
    }
}
