<?php

require_once 'model/dock/DockManager.php'; // Update the path to your DockManager file

class InitialDockListViewController {
    public function displayInitialDockListView() {
        $dockManager = new DockManager();
        $dockList = $dockManager->getDockList(); // Fetch docks from the database using DockManager

        // Load the view and pass data
        include 'view/initialDockListView.php';
    }
}
