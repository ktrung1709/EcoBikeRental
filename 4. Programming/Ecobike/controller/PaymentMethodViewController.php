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
        $existingCard = $creditCardManager->getCardByCardNumber($cardNum);
    
        if ($existingCard !== null) {
            try {
                // Card with the same number exists, update cardId and store in session
                $existingCardId = $existingCard->getId();
                
                if ($existingCardId !== null) {
                    $_SESSION["cardId"] = $existingCardId;
                    
                    // Redirect to the paymentTransaction request
                    header("Location: requestHandler.php?request=paymentTransaction");
                    exit; // Make sure to exit after redirecting
                } else {
                    echo "Error: Existing card ID is null.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        $cardId = $creditCardManager->saveCreditCard($creditCard);
        $_SESSION["cardId"] = $cardId;
        if ($cardId !== 'save failed') {
           
            // Redirect to the paymentTransaction request
            header("Location: requestHandler.php?request=paymentTransaction");
            exit; // Make sure to exit after redirecting
        } else {
            echo "Payment processing failed.";
        }
    }
}
?>
