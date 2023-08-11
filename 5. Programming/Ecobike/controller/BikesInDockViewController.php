<?php
require_once 'model/bike/BikeManager.php'; // Update the path to your DockManager file
class BikesInDockViewController {
    public function displayBikesInDockView($dockId) {
        $bikeManager = new BikeManager();
        $bikeList = $bikeManager->getBikeListInDock($dockId);
        


        // Load the view and pass data
        include 'view/bikesInDockView.php'; // Update the path to the view file
    }
}
