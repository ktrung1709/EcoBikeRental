<?php

require_once 'model/payment/paymentCard/creditCard/CreditCard.php';
require_once 'model/db/EBRDB.php';



/**
 * Model to manage all credit card and handle database access
 *
 * Class CreditCardManager
 * @package model\payment\paymentCard\creditCard
 */
class CreditCardManager
{
    private static $instance; // singleton

    /**
     * Singleton instance access
     *
     * @return CreditCardManager instance
     */
    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new CreditCardManager();
        }
        return self::$instance;
    }

    /**
     * Query card info from database via id
     *
     * @param $cardId string card's uuid
     * @return CreditCard instance of wanted card, null if not found
     */
    public function getCardById($cardId)
    {
        // query the card
        $SQL = "SELECT * FROM card " .
               "WHERE id = ?";
    
        try {
            $conn = EBRDB::getConnection();
            $pstmt = $conn->prepare($SQL);
            // Set up parameters
            $pstmt->bindParam(1, $cardId);
            // Handle result set
            $rs = $pstmt->execute();
            if ($rs && ($row = $pstmt->fetch())) {
                $card = new CreditCard(
                    $row["card_num"],
                    $row["card_owner"],
                    $row["security_code"],
                    $row["exp_date"],
                    $cardId
                );
                return $card;
            }
        } catch (\PDOException $ex) {
            // Echo the error message
            echo "An error occurred: " . $ex->getMessage();
        }
        return null;
    }

    public function getCardByCardNumber($cardNumber)
    {
        // query the card
        $SQL = "SELECT * FROM card " .
               "WHERE card_num = ? " .
               "ORDER BY id " .
               "LIMIT 1";

        try {
            $conn = EBRDB::getConnection();
            $pstmt = $conn->prepare($SQL);
            // Set up parameters
            $pstmt->bindParam(1, $cardNumber);
            // Handle result set
            $rs = $pstmt->execute();
            if ($rs && ($row = $pstmt->fetch())) {
                $sc = 0;
                for ($i = 0; $i <= 9; $i++) {
                    for ($j = 0; $j <= 9; $j++) {
                        for ($l = 0; $l <= 9; $l++) {
                            if ($row["security_code"] === Utils::sha256("" . $i . $j . $l)) {
                                $sc = 100 * $i + 10 * $j + $l;
                                echo $sc;
                            }
                        }
                    }
                }
                return new CreditCard(
                    $row["id"],
                    $row["card_num"],
                    $row["card_owner"],
                    $sc,
                    $row["exp_date"]
                );
            }
        } catch (\PDOException $ex) {
            $ex->getMessage();
        }
        return null;
    }

    /**
     * Save the card into the database
     *
     * @param $creditCard CreditCard instance of credit card to be saved
     * @return string uuid of the card in the newly created records
     */
   public function saveCreditCard($creditCard) {
    $id = null;
    $SQL = "INSERT INTO card (card_num, card_owner, security_code, exp_date) VALUES (?, ?, ?, ?)";
    try {
        $conn = EBRDB::getConnection();
        $pstmt = $conn->prepare($SQL);

        // Bind values using bindValue() instead of bindParam()
        $pstmt->bindValue(1, $creditCard->getCardNum(), PDO::PARAM_STR);
        $pstmt->bindValue(2, $creditCard->getCardOwner(), PDO::PARAM_STR);
        $pstmt->bindValue(3, $creditCard->getSecurityCode(), PDO::PARAM_STR);
        $pstmt->bindValue(4, $creditCard->getExpDate(), PDO::PARAM_STR);

        // Handle update
        $affectedRows = $pstmt->execute();

        // check the affected rows
        if ($affectedRows > 0) {
            // Get the last inserted ID
            $id = $conn->lastInsertId();
        }
    } catch (\PDOException $ex) {
        echo $ex->getMessage();
    }
    $creditCard->setId($id);
    return $id;
}

}
