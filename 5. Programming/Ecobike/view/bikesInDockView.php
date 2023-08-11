<!DOCTYPE html>
<html>
<head>
    <title>Bike Details View</title>
</head>
<body>
    <h1>Bikes In Dock View</h1>
    <?php foreach ($bikeList as $bike): ?>
            <li><a href="requestHandler.php?request=bikeDetails&bikeId=<?php echo $bike->getId(); ?>">
            <?php echo $bike->getId(); ?></a></li>
        <?php endforeach; ?>
</body>
</html>
