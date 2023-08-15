<?php 

require_once 'controller/InitialDockListViewController.php';
require_once 'controller/BikesInDockViewController.php';
require_once 'controller/BikeDetailsViewController.php';
require_once 'controller/PaymentMethodViewController.php'; // Include your PaymentMethodViewController
require_once 'controller/PayDepositViewController.php';
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
    $paymentMethodViewController->displayPaymentMethodView();
} elseif ($request === 'processPayment') {
    $formData = $_POST;
    $paymentMethodViewController = new PaymentMethodViewController();
    $paymentMethodViewController->processPayment($formData);
} elseif ($request === 'paymentTransaction') {
   
    $paymentTransactionViewController = new PayDepositTransactionViewController();
    $paymentTransactionViewController->displayPayDepositTransactionView();
} elseif ($request === 'confirmPayment') {
    $formData = $_POST;
    $paymentTransactionViewController = new PaymentTransactionViewController();
    $paymentTransactionViewController->confirmPayment($formData);
} elseif ($request === 'processDeposit') {
    $formData1 = $_POST;
    $paymentTransactionViewController = new PayDepositTransactionViewController();
    $paymentTransactionViewController->processDeposit($formData1);
}
?>
