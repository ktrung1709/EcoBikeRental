<?php
session_start();
session_write_close();
session_start();
// Include the necessary files
require_once 'controller/InitialDockListViewController.php';
require_once 'controller/BikesInDockViewController.php';
require_once 'controller/BikeDetailsViewController.php';
require_once 'model/dock/Dock.php'; // Include your model files as needed
require_once 'model/bike/Bike.php'; // Include your model files as needed

// Define your data (dockList, bikesInDock, bike) here

// Display the initial dock list view when no request is specified
$initialDockListViewController = new InitialDockListViewController();
$initialDockListViewController->displayInitialDockListView();


