<!DOCTYPE html>
<html>
<head>
    <title>Initial Dock List View</title>
</head>
<body>
    <h1>Initial Dock List View</h1>
    <ul>
        <?php foreach ($dockList as $dock): ?>
            <li><a href="requestHandler.php?request=bikesInDock&dockId=<?php echo $dock->getId(); ?>"><?php echo $dock->getName(); ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
