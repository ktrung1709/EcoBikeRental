<?php 
require_once 'controller/InitialDockListViewController.php';
require_once 'controller/BikesInDockViewController.php';
require_once 'controller/BikeDetailsViewController.php';
require_once 'controller/PaymentMethodViewController.php'; // Include your PaymentMethodViewController

require_once 'model/dock/DockManager.php'; // Include your DockManager file
require_once 'model/bike/BikeManager.php'; // Include your BikeManager file

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
} elseif ($request === 'paymentMethod') {
    // $bikeId = $_GET['bikeId'];
    $paymentMethodViewController = new PaymentMethodViewController();
    $paymentMethodViewController->displayPaymentMethodView($bikeId);
} elseif ($request === 'processPayment') {
    $formData = $_POST;
    $paymentMethodViewController = new PaymentMethodViewController();
    $paymentMethodViewController->processPayment($formData);
} elseif ($request === 'paymentTransaction') {
    $bikeId = $_GET['bikeId'];
    $cardId = $_GET['cardId'];
    $paymentTransactionViewController = new PaymentTransactionViewController();
    $paymentTransactionViewController->displayPaymentTransactionView($bikeId, $cardId);
} elseif ($request === 'confirmPayment') {
    $formData = $_POST;
    $paymentTransactionViewController = new PaymentTransactionViewController();
    $paymentTransactionViewController->confirmPayment($formData);
}
?>
