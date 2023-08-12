<?php

require_once 'model/payment/paymentCard/creditCard/CreditCard.php'; // Update the path to your CreditCard class
require_once 'model/payment/paymentCard/creditCard/CreditCardManager.php'; // Update the path to your CreditCardManager class

class PaymentMethodViewController {
    public function displayPaymentMethodView() {
        include 'view/paymentMethodView.php';
    }
    
    public function processPayment($formData) {
        // Retrieve and validate form data
        $cardNum = $formData['cardNum'];
        $cardOwner = $formData['cardOwner'];
        $securityCode = $formData['securityCode'];
        $expDate = $formData['expDate'];
        
        // Create a CreditCard object
        $creditCard = new CreditCard($cardNum, $cardOwner, $securityCode, $expDate);
        
        // Save the credit card information
        $creditCardManager = CreditCardManager::getInstance();
        $cardId = $creditCardManager->saveCreditCard($creditCard);
        
        if ($cardId !== 'save failed') {
            echo "Payment processed successfully. Card ID: " . $cardId;
        } else {
            echo "Payment processing failed.";
        }
    }
}
?>
