<?php
session_start();
require_once 'model/db/EBRDB.php';
require_once 'model/dock/DockManager.php'; // Include your DockManager file
require_once 'model/bike/BikeManager.php'; // Include your BikeManager file
require_once 'model/payment/paymentCard/creditCard/CreditCard.php'; // Update the path to your CreditCard class
require_once 'model/payment/paymentCard/creditCard/CreditCardManager.php'; // Update the path to your CreditCardManager class
require_once 'model/payment/transaction/PaymentTransactionManager.php';
require_once 'model/payment/transaction/PaymentTransaction.php';

require_once 'model/session/Session.php';
require_once 'model/session/SessionManager.php'; // Include your SessionManager class

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action === 'end') {
    // Handle ending the session
    $end_time = $_POST['end_time'];
    $affectedRows = endSession1($end_time);

    if ($affectedRows !== false) {
        if ($affectedRows > 0) {
            echo "success"; // Return a success response
        } else {
            echo "error"; // Return an error response
        }
    } else {
        echo "error"; // Return an error response if an exception occurred
    }
}

function endSession1($end_time) {
    $sessionId = $_SESSION['sessionId'];
    $sessionManager = SessionManager::getInstance();
    $session = $sessionManager->getSessionById($sessionId);
    
    $session->setEndTime(new DateTime('now', new DateTimeZone('Asia/Bangkok')));

    $pdo = EBRDB::getConnection();

    $sql = "UPDATE session " . "SET end_time = ?" . "WHERE id = ?";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(1, $session->getEndTime()->format(Utils::DATE_FORMATER));
        $stmt->bindValue(2, $session->getId());

        $stmt->execute();
        return $stmt->rowCount(); // Return the affected rows count
    } catch (PDOException $ex) {
        echo $ex->getMessage(); // Print the error message for debugging
        return false; // Return false to indicate an error occurred
    }
}
?>
