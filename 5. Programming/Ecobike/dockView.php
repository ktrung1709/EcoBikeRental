<!DOCTYPE html>
<html>
<head>
    <title>EBR Bike List in Dock</title>
</head>
<body>
    <?php
    require_once 'model/dock/DockManager.php';
    require_once 'model/bike/BikeManager.php';
    $dockManager = DockManager::getInstance();
    $bikeManager = BikeManager::getInstance();

    if (isset($_GET['id'])) {
        $dockId = $_GET['id'];
        $dock = $dockManager->getDockById($dockId);
        if ($dock) {
            echo '<h1>Bikes in ' . $dock->getName() . '</h1>';
            $bikeList = $bikeManager->getBikesByDockId($dockId);

            if (count($bikeList) > 0) {
                echo '<ul>';
                foreach ($bikeList as $bike) {
                    echo '<li>' . $bike->getBikeType() . ' - Barcode: ' . $bike->getBarcode() . '</li>';
                }
                echo '</ul>';
            } else {
                echo '<p>No bikes available in this dock.</p>';
            }
        } else {
            echo '<p>Invalid dock ID.</p>';
        }
    } else {
        echo '<p>No dock selected.</p>';
    }
    ?>
    <br>
    <a href="index.php">Back to Docks List</a>
</body>
</html>
