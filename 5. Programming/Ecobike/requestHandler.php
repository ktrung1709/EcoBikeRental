<?php 
require_once 'controller/InitialDockListViewController.php';
require_once 'controller/BikesInDockViewController.php';
require_once 'controller/BikeDetailsViewController.php';
require_once 'model/dock/Dock.php'; // Include your model files as needed
require_once 'model/bike/Bike.php'; // Include your model files as needed


// Handle requests based on user interaction
$request = $_GET['request'];

if ($request === 'bikesInDock') {
    $dockId = $_GET['dockId'];
    $bikesInDockViewController = new BikesInDockViewController();
    $bikesInDockViewController->displayBikesInDockView($dockId);
} elseif ($request === 'bikeDetails') {
    $bikeId = $_GET['bikeId'];
    $bikeDetailsViewController = new BikeDetailsViewController();
    $bikeDetailsViewController->displayBikeDetailsView($bikeId);
}

?>