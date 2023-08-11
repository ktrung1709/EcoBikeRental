<!DOCTYPE html>
<html>

<head>
    <title>Bike Details View</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            /* overflow-x: hidden; */
        }

        #dockPane {
            max-height: -Infinity;
            max-width: -Infinity;
            min-height: -Infinity;
            min-width: -Infinity;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: row;
            align-items: center;

        }

        #dockImg {
            width: 400px;
            height: 300px;
            margin-top: -4px;
        }

        #dockName {
            fill: #8c36c0;
            font-family: "System Bold", Arial, sans-serif;
            font-size: 48px;
            text-align: center;
        }

        #dockCapacity,
        #dockStandardBikeNum,
        #dockTwinBikeNum,
        #dockEBikeNum,
        #dockTwinEBikeNum,
        #dockAddress {
            opacity: 0.54;
            stroke-type: outside;
            stroke-width: 0.0;
            font-family: Arial, sans-serif;
            font-size: 24px;
        }

        #parkingIcon,
        #standardBikeIcon,
        #twinBikeIcon,
        #standardEBikeIcon,
        #twinEBikeIcon {
            width: 20px;
            height: 20px;
            margin-right: 20px;
        }

        #navbar {
            background-color: #8c36c0;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            height: 60px;
        }

        #hboxBikeList {
            display: flex;
            justify-content: flex-start;
            align-items: center;
            min-height: 400px;
            min-width: 1100px;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            padding: 0 20px;
        }

        /* Additional styles for the new layout */
        #dockInfoWrapper {
            display: flex;
            flex-direction: row;
            align-items: center;
        }

        #dockInfo {
            margin-left: 20px;
        }

        .totalIcon {
            position: relative;
            left: 650px;
        }

        #dockIcon {
            display: flex;
            flex-direction: column;
            align-items: center;
            /* justify-content: flex-end; */
            margin-left: auto;
        }

        .infodockIcon {
            display: flex;
            flex-direction: row;
            text-align: center;
        }

        .container {
            max-height: none;
            max-width: none;
            min-height: none;
            min-width: none;
            height: 350px;
            width: 300px;
            background-color: white;
        }

        .image-container {
            position: relative;
            left: 51px;
            top: 10px;
        }

        .image {
            height: 150px;
            width: 200px;
        }

        .text {
            color: #8c36c0;
            position: relative;
            left: 1px;
            /* top: 228px; */
            text-align: center;
            width: 300px;
            font-family: Arial;
            font-size: 24px;
        }

        .button {
            text-align: center;
            position: relative;
            left: 93px;
            /* top: 280px; */
            height: 44px;
            width: 115px;
            background-color: #8C36C0;
            color: white;
            font-family: Arial;
            font-size: 14px;
            font-weight: bold;
        }

        .list-bike {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .list-bike-detail {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div>
        <div id="navbar"></div>
    </div>
    <br>
    <!-- <h1>Bikes In Dock View</h1> -->
    <div id="dockPaneWrapper">
        <div id="dockPane">
            <div id="dockInfoWrapper">
                <!-- <img id="dockImg" src=" . $dock->getImageURL() . " alt="Dock Image"> -->
                <img id="dockImg" src="<?php echo $dock->getImageURL(); ?>" alt="Dock Image">

                <div id="dockInfo">
                    <!-- <div id="dockName">' . $dock->getName() . '</div> -->
                    <div id="dockName"><?php echo $dock->getName(); ?></div>
                    <div>Address: <?php echo $dock->getLocation(); ?></div>
                    <!-- <div id="dockCapacity">200</div> -->
                </div>
            </div>
        </div>
    </div>
    <!-- <?php foreach ($bikeList as $bike) : ?>
        <li><a href="requestHandler.php?request=bikeDetails&bikeId=<?php echo $bike->getId(); ?>">
                <?php echo $bike->getId(); ?></a></li>
    <?php endforeach; ?> -->
    
</body>

</html>