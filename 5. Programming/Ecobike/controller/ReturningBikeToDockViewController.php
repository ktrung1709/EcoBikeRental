<?php

require_once 'model/dock/DockManager.php'; // Update the path to your DockManager file
require_once 'model/session/SessionManager.php';

class ReturningBikeToDockViewController {
    public function displayReturningBikeToDockView($sessionId) {
        $dockManager = new DockManager();
        $dockList = $dockManager->getDockList(); // Fetch docks from the database using DockManager

        // $sessionManager = SessionManager::getInstance();
        // $session = $sessionManager->getSessionById($sessionId);

        // Load the view and pass data
        include 'view/returningBikeToDockView.php';
    }
}
