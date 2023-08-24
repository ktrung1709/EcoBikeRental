<?php

class InvoiceViewController {
    public function displayInvoiceView() {

        $sessionId = $_SESSION['sessionId'];
        $sessionManager = SessionManager::getInstance();
        $session = $sessionManager->getSessionById($sessionId);

        $bikeManager = new BikeManager();
        $bikeId = $_SESSION["bikeId"];
        $bike = $bikeManager->getBikeById($bikeId);

        $cardManager = new CreditCardManager();
        $cardId = $_SESSION["cardId"];
        $card = $cardManager->getCardById($cardId);

        // Load the view and pass data
        include 'view/invoiceView.php';
    }

    public function processInvoice($formData) {
        $cardNum = $formData["card_number"];
        $cardOwner = $formData['cardOwner'];
        $securityCode = $formData['security_code'];
        $expDate = $formData['expDate'];
        $difference =$formData['difference'] ;
        
        $type = 'Return';
        $method = 'CreditCard';

        
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
                    
                    
                    // Redirect to the paymentTransaction request
                    $paymentTransaction = new PaymentTransaction( $existingCard,$type,$method,$difference);
                    $paymentTransactionManager = PaymentTransactionManager::getInstance();
                     $paymentTransactionId = $paymentTransactionManager->savePaymentTransaction($paymentTransaction); 
                     $createdPaymentTransaction = $paymentTransactionManager->getTransactionById($paymentTransactionId);
                     $sessionId = $_SESSION['sessionId'];
        $sessionManager = SessionManager::getInstance();
        $session = $sessionManager->getSessionById($sessionId);
        $session->setReturnTransaction( $paymentTransactionId);

        $pdo = EBRDB::getConnection();
    
        $sql = "UPDATE session " . "SET return_transactionid = ?" . "WHERE id = ?";
    
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $session->getReturnTransaction());
            $stmt->bindValue(2, $session->getId());
    
            $stmt->execute();
            $_SESSION['transactionSuccess'] = true;
            header("Location: index.php");
            exit;
        } catch (PDOException $ex) {
            echo $ex->getMessage(); // Print the error message for debugging
            return false; // Return false to indicate an error occurred
        }
    


                } else {
                    echo "Error: Existing card ID is null.";
                }
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        
        $cardId = $creditCardManager->saveCreditCard($creditCard);
       
        if ($cardId !== 'save failed') {
           
            // Redirect to the paymentTransaction request
            $paymentTransaction = new PaymentTransaction( $cardId,$type,$method,$difference);
            $paymentTransactionManager = PaymentTransactionManager::getInstance();
             $paymentTransactionId = $paymentTransactionManager->savePaymentTransaction($paymentTransaction); 
             $createdPaymentTransaction = $paymentTransactionManager->getTransactionById($paymentTransactionId);
             $sessionId = $_SESSION['sessionId'];
$sessionManager = SessionManager::getInstance();
$session = $sessionManager->getSessionById($sessionId);
$session->setReturnTransaction( $paymentTransactionId);

$pdo = EBRDB::getConnection();

$sql = "UPDATE session " . "SET return_transactionid = ?" . "WHERE id = ?";

try {
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $session->getReturnTransaction());
    $stmt->bindValue(2, $session->getId());

    $stmt->execute();
    $_SESSION['transactionSuccess'] = true;
    header(Location :"index.php");
    exit;
} catch (PDOException $ex) {
    echo $ex->getMessage(); // Print the error message for debugging
    return false; // Return false to indicate an error occurred
}
           
        } else {
            echo "Payment processing failed.";
        }

    
}

}