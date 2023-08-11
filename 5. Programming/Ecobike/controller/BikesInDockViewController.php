<?php
require_once 'model/bike/BikeManager.php'; // Update the path to your DockManager file
require_once 'model/dock/dockManager.php';
require_once 'controller/InitialDockListViewController.php';
class BikesInDockViewController {
    public function displayBikesInDockView($dockId) {
        $bikeManager = new BikeManager();
        $bikeList = $bikeManager->getBikeListInDock($dockId);


        $dockManager = new DockManager();
        $dock = $dockManager->getDockById($dockId);

        // Load the view and pass data
        include 'view/bikesInDockView.php'; // Update the path to the view file
    }
}
