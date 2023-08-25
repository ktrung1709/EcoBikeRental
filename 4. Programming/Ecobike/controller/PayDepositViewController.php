<?php

require_once 'model/payment/transaction/PaymentTransactionManager.php';
require_once 'model/payment/transaction/PaymentTransaction.php';
require_once 'model/bike/BikeManager.php';
require_once 'model/bike/Bike.php';
require_once 'model/payment/paymentCard/creditCard/CreditCard.php';
require_once 'model/payment/paymentCard/creditCard/CreditCardManager.php';
require_once 'model/session/Session.php';
require_once 'model/session/SessionManager.php';
class PayDepositTransactionViewController
{
  public function displayPayDepositTransactionView()
  {
    $bikeManager = new BikeManager();
    $bikeId1 = $_SESSION["bikeId"];
    $bike = $bikeManager->getBikeById($bikeId1);

    $cardManager = new CreditCardManager();
    $cardId1 = $_SESSION["cardId"];

    $card1 = $cardManager->getCardById($cardId1);

    include 'view/payDepositTransactionView.php';
  }

  public function processDeposit($formData)
  {
    $cardId = $formData['cardId'];
    $type = "Deposit";
    $method = "CreditCard";
    $amount = $formData['deposit'];
    $bikeId = $formData['bikeId'];

    $cardManager = new CreditCardManager();
    $card = $cardManager->getCardById($cardId);
    $bikeManager = new BikeManager();
    $bike = $bikeManager->getBikeById($bikeId);
    $paymentTransaction = new PaymentTransaction($card, $type, $method, $amount);
    $paymentTransactionManager = PaymentTransactionManager::getInstance();
    $paymentTransactionId = $paymentTransactionManager->savePaymentTransaction($paymentTransaction);
    $createdPaymentTransaction = $paymentTransactionManager->getTransactionById($paymentTransactionId);
    $sessionManager = SessionManager::getInstance();
    $newSession = $sessionManager->createSession($bike, $card, $createdPaymentTransaction);
    $_SESSION['sessionId'] = $newSession->getId();
    header("Location: requestHandler.php?request=processSession");
    exit; // Make sure to exit after redirecting


  }
}
