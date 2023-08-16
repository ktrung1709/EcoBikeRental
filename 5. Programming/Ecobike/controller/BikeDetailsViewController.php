<?php
session_start();
require_once 'model/bike/Bike.php'; // Update the path to your DockManager file
class BikeDetailsViewController {
    public function displayBikeDetailsView($bikeId) {
        // Load the view and pass data
        $bikeManager = new BikeManager();
        $bike = $bikeManager->getBikeById($bikeId);
        $_SESSION["bikeId"] = $bike->getId();
		
		 
        include 'view/bikeDetailsView.php'; // Update the path to the view file
    }
}
