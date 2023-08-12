<?php

require_once('EBRDB.php');  // Assuming EBRDB class definition here

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
            . "WHERE id = ?::uuid";

        try {
            $conn = EBRDB::getConnection();  // Assuming EBRDB::getConnection() method is defined
            $stmt = $conn->prepare($SQL);
            // Set up parameters
            $stmt->bindValue(1, $transactionId, PDO::PARAM_STR);
            // Handle result set
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            return new PaymentTransaction(
                $result['id'],
                $result['transaction_id'],
                $result['type'],
                $result['amount'],
                $result['method']
            );
        } catch (PDOException $ex) {
            $ex->getMessage();
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
        $SQL = "INSERT INTO payment_transaction(type, amount, method, card_id, transaction_id) " .
            "VALUES (?, ?, ?, ?::uuid, ?)";

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
            $stmt->bindValue(5, $paymentTransaction->getTransactionId(), PDO::PARAM_STR);
            // Handle update
            $affectedRows = $stmt->execute();
            // check the affected rows
            if ($affectedRows > 0) {
                // get the id back
                $id = $conn->lastInsertId();
            }
        } catch (PDOException $ex) {
            $ex->getMessage();
        }
        $paymentTransaction->setId($id);
        return $id;
    }
}
