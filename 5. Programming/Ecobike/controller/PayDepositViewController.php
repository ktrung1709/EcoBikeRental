<?php
session_start();
require_once 'model/payment/transaction/PaymentTransactionManager.php';
require_once 'model/payment/transaction/PaymentTransaction.php';
require_once 'model/bike/BikeManager.php';
require_once 'model/bike/Bike.php';
require_once 'model/payment/paymentCard/creditCard/CreditCard.php';
require_once 'model/payment/paymentCard/creditCard/CreditCardManager.php'; 

class PayDepositTransactionViewController {
      public function displayPayDepositTransactionView(){
        $bikeManager = new BikeManager();
        $bikeId1 = $_SESSION["bikeId"];
        $bike = $bikeManager->getBikeById($bikeId1);

        $cardManager = new CreditCardManager();
        $cardId1 = $_SESSION["cardId"];
        
        $card1 = $cardManager->getCardById($cardId1);

        include 'view/payDepositTransactionView.php';
      }

      public function processDeposit($formData){
        $cardId = $formData['cardId'];
        $type = "Deposit";
        $method = "CreditCard";
        $amount = $formData['deposit'];
          
        $cardManager = new CreditCardManager();
        $card = $cardManager->getCardById($cardId);
         
        $paymentTransaction = new PaymentTransaction($card,$type,$method,$amount);
        $paymentTransactionManager = PaymentTransactionManager::getInstance();
         $paymentTransactionId = $paymentTransactionManager->savePaymentTransaction($paymentTransaction);

         echo $paymentTransactionId;

      }





}
