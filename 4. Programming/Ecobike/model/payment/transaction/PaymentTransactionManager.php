<?php

require_once('model/db/EBRDB.php');  // Assuming EBRDB class definition here
require_once('model/payment/transaction/PaymentTransaction.php');
require_once 'model/payment/paymentCard/creditCard/CreditCard.php';

class PaymentTransactionManager {

    private static $instance;  // singleton

    /**
     * singleton instance access
     *
     * @return PaymentTransactionManager instance
     */
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new PaymentTransactionManager();
        }
        return self::$instance;
    }

    /**
     * query Payment Transaction info from database via id
     *
     * @param string $transactionId transaction's uuid
     * @return PaymentTransaction instance of wanted transaction, null if didn't found
     */
    public function getTransactionById($transactionId) {
        // query the card
        $SQL = "SELECT * FROM payment_transaction "
            . "WHERE id = ?";

        try {
            $conn = EBRDB::getConnection();  // Assuming EBRDB::getConnection() method is defined
            $stmt = $conn->prepare($SQL);
            // Set up parameters
            $stmt->bindValue(1, $transactionId, PDO::PARAM_STR);
            // Handle result set
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $cardManager = CreditCardManager::getInstance();
            $card = $cardManager->getCardById($result['card_id']);
            return new PaymentTransaction(
                $card,
                $result['type'],
                $result['method'],
                $result['amount'],$result['created_at'],$result['id']
            );
        } catch (PDOException $ex) {
            $ex->getMessage();
            echo $ex;
        }
        return null;
    }

    /**
     * save transaction into database as new record
     *
     * @param PaymentTransaction $paymentTransaction transaction to be saved
     * @return string uuid of newly added transaction's record
     */
    public function savePaymentTransaction($paymentTransaction) {
        $SQL = "INSERT INTO payment_transaction(type, amount, method, card_id) " .
            "VALUES (?, ?, ?, ?)";

        $id = "save failed";

        // Insert new row
        try {
            $conn = EBRDB::getConnection();  // Assuming EBRDB::getConnection() method is defined
            $stmt = $conn->prepare($SQL);
            // Set up parameters
            $stmt->bindValue(1, $paymentTransaction->getType(), PDO::PARAM_STR);
            $stmt->bindValue(2, $paymentTransaction->getAmount(), PDO::PARAM_INT);
            $stmt->bindValue(3, $paymentTransaction->getMethod(), PDO::PARAM_STR);
            $stmt->bindValue(4, $paymentTransaction->getCard()->getId(), PDO::PARAM_STR);
           
            // Handle update
            $affectedRows = $stmt->execute();
            // check the affected rows
            if ($affectedRows > 0) {
                // get the id back
                $id = $conn->lastInsertId();
            }
        } catch (PDOException $ex) {
            $ex->getMessage();
           
                echo "Error: " . $ex->getMessage(); // Output the error message for debugging
                // or log the error message using an appropriate method
            }
        
        $paymentTransaction->setId($id);
        return $id;
    }
}
