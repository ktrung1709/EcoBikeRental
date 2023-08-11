<!DOCTYPE html>
<html>

<head>
    <title>Initial Dock List View</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        a {
            text-decoration: none;
            color: black;
        }

        #container {
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: stretch;
            height: 100vh;
            width: 100%;
        }

        #navbar {
            background-color: #8c36c0;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            height: 60px;
        }

        #scrollPane {
            flex: 1;
            overflow-y: scroll;
            background-color: #FFFFFF;
        }

        #content {
            display: flex;
            flex-direction: column;
            align-items: stretch;
            padding: 20px;
        }

        .section {
            margin: 20px 0;
            border: 2px solid #8C36C0;
            border-radius: 5px;
            background-color: #F5F5F5;
            padding: 20px;
        }

        /* .search-box {
        /* display: flex; 
        align-items: center;
        background-color: #F0F0F0;
        border-radius: 2px;
        padding: 0 10px;
        /* width: 20px; 
    } */
        .search-box {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        .search-input {
            font-size: 20px;
            background-color: rgb(228, 227, 227);
            height: 40px;
            margin-left: 100px;
            margin-top: 30px;
            border: 1px solid rgb(121, 118, 118);
            /* border-radius: 0 25% 0 25%; */
        }

        .search-icon {
            cursor: pointer;
            margin-right: 10px;
        }

        .custom-button {
            background-color: #CC99FF;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 30px;
            margin-left: 20px;
        }

        .custom-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .custom-button:focus {
            outline: none;
        }


        .dock-list {
            display: flex;
            justify-content: space-between;
        }

        .dock {
            margin: 0 50px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .dock-title {
            font-size: 24px;
            color: #8c36c0;
            margin-bottom: 10px;
        }

        .dock-item {
            margin: 10px 0;
            font-size: 18px;
        }

        .dock-img {
            width: 24px;
            height: 24px;
            cursor: pointer;
        }

        .dock-img:hover {
            filter: drop-shadow(0px 0px 2px rgba(0, 0, 0, 0.5));
        }

        #dockPane {
            max-height: -Infinity;
            max-width: -Infinity;
            cursor: pointer;
            background-color: #FFFFFF;
            border-radius: 5px;
            border-width: 4px;
            border-color: #FAE715;
            display: flex;
            flex-direction: row;
            align-items: center;
            padding: 10px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        .dockImg {
            width: 300px;
            height: 300px;
            margin-right: 14px;
        }

        #content {
            display: flex;
            flex-direction: column;
        }

        .section {
            margin-top: 5px;
        }

        .dock-title {
            color: #8c36c0;
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .info {
            font-family: Arial;
            font-size: 20px;
            color: #6b6b6b;
        }
    </style>
</head>

<body>
    <!-- <h1>Initial Dock List View</h1>
    <ul>
        <?php foreach ($dockList as $dock) : ?>
            <li><a href="requestHandler.php?request=bikesInDock&dockId=<?php echo $dock->getId(); ?>"><?php echo $dock->getName(); ?></a></li>
        <?php endforeach; ?>
    </ul> -->

    <!-- ------------------------------------------ -->
    <div id="container">
        <div id="navbar"></div>
        <div id="scrollPane">
            <div id="content">

                <div class="search-box">
                    <h1 style="color: #8c36c0; font-size: 48px; margin-left: 305px; margin-top: 68.203125px;">DOCKS</h1>
                    <input class="search-input" type="text" placeholder="Search">
                    <button class="custom-button">Search</button>

                </div>
               
                <?php 
foreach ($dockList as $dock) {
    echo '
        <div class="section">
            <div id="dockPane" onclick="dockImgClickListener()">
                <img class="dockImg" src="dockImg1.png" alt="Dock Image">
                <div id="content">
                    <div class="section">
                        <div class="dock-title"><a href="requestHandler.php?request=bikesInDock&dockId=' . $dock->getId() . '">' . $dock->getName() . '</a></div>
                    </div>
                    <div class="section">
                        <div class="info">
                            <span>Address:</span>
                            <span id="dockAddress"><a href="requestHandler.php?request=bikesInDock&dockId=' . $dock->getId() . '">' . $dock->getLocation() . '</a></span>
                        </div>
                    </div>
                    <div class="section">
                        <div class="info">
                            <span>Bike Number:</span>
                            <span id="dockBikeNum">100/200</span>
                        </div>
                    </div>
                    <div>
                        <button class="custom-button"><a href="requestHandler.php?request=bikesInDock&dockId=' . $dock->getId() . '">View detail</a></button>
                    </div>
                </div>
            </div>
        </div>';
}
?>

            </div>
        </div>
    </div>
</body>

</html>