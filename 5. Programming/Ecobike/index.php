<!DOCTYPE html>
<html>
<head>
    <title>EBR Dock and Bike List</title>
</head>
<body>
    <h1>List of Docks</h1>
    <ul>
        <?php
        require_once 'model/dock/DockManager.php';
        $dockManager = DockManager::getInstance();
        $dockList = $dockManager->getDockList();

        foreach ($dockList as $dock) {
            echo '<li><a href="dockView.php?id=' . $dock->getId() . '">' . $dock->getName() . '</a></li>';
        }
        ?>
    </ul>
</body>
</html>
