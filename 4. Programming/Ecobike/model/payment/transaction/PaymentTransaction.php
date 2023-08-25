<?php



class PaymentTransaction {

    private $errorCode;
    private CreditCard $card;
    private $transactionId;
    private $transactionContent;
    private $amount;
    private $createdAt;
    private $id;
    private $type;
    private $method;
    
    public function __construct( $card,$type,$method,   $amount, $createdAt = null,$id = null) {
        $this->card = $card;
        $this->type = $type;
        $this->amount = $amount;
        $this->method = $method;
        $this->createdAt = $createdAt;
        $this->id = $id;
    }

    public function PaymentTransaction($id , $transactionId, $type, $amount, $method) {
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
