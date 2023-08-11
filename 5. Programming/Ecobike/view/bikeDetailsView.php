<!DOCTYPE html>
<html>
<head>
    <title>Bike Details View</title>
</head>
<body>
    <h1>Bike Details View</h1>
    <p>Bike ID: <?php echo $bike->getId(); ?></p>
    <p>Barcode: <?php echo $bike->getBarcode(); ?></p>
    <p>Type: <?php echo $bike->getBikeType(); ?></p>
    <p>Dock ID: <?php echo $bike->getDockId(); ?></p>
    <!-- Display other bike details here -->
</body>
</html>
