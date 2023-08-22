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
}
