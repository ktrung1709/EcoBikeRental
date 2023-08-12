<?php



class PaymentTransaction {

    private $errorCode;
    private $card;
    private $transactionId;
    private $transactionContent;
    private $amount;
    private $createdAt;
    private $id;
    private $type;
    private $method;
    
    public function __construct($errorCode, $card, $transactionId, $transactionContent, $amount, $createdAt) {
        $this->errorCode = $errorCode;
        $this->card = $card;
        $this->transactionId = $transactionId;
        $this->transactionContent = $transactionContent;
        $this->amount = $amount;
        $this->createdAt = $createdAt;
    }

    public function PaymentTransaction($id, $transactionId, $type, $amount, $method) {
        $this->id = $id;
        $this->type = $type;
        $this->amount = $amount;
        $this->method = $method;
        $this->transactionId = $transactionId;
    }
    
    public function getErrorCode() {
        return $this->errorCode;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getCard() {
        return $this->card;
    }

    public function setCard($card) {
        $this->card = $card;
    }

    public function getMethod() {
        return $this->method;
    }

    public function setMethod($method) {
        $this->method = $method;
    }

    public function getTransactionContent() {
        return $this->transactionContent;
    }

    public function getTransactionId() {
        return $this->transactionId;
    }

    public function setTransactionContent($transactionContent) {
        $this->transactionContent = $transactionContent;
    }
}
