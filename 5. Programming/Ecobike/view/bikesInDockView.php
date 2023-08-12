<!DOCTYPE html>
<html>

<head>
    <title>Bike Details View</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        a {
            text-decoration: none;
            color: black;
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
            /* top: 280px;  */
            height: 44px;
            width: 115px;
            border: none;
            background-color: #CC99FF;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        /* .button {
            text-align: center;
            position: relative;
            background-color: #CC99FF;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            /* margin-top: 30px;
            margin-left: 20px; *
        } */

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .button:focus {
            outline: none;
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

        .custom-button {
            background-color: #99CCFF;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 30px;
            margin-left: 600px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <div style="position: relative; background-color: #8C36C0; height: 60px; width: 1366px;">
        <img id="logo" src="image/LOGO.png" alt="Logo" style="position: absolute; top: 0; left: 0; cursor: hand; width: 176px; height: 60px;">

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
    <div class="list-bike">
        <?php foreach ($bikeList as $bike) : ?>
            <!-- <li><a href="requestHandler.php?request=bikeDetails&bikeId=<?php echo $bike->getId(); ?>">
                <?php echo $bike->getId(); ?></a></li> -->

            <div class="list-bike-detail">
                <div class="image-container">
                    <img class="image" src="<?php echo $bike->getImageURL(); ?>" alt="Bike Image">
                </div>
                <p class="text"> Code: <?php echo $bike->getId(); ?> </p>
                <p class="text"><?php echo $bike->getBikeType(); ?></p>
                <button class="button"><a href="requestHandler.php?request=bikeDetails&bikeId=<?php echo $bike->getId(); ?>">View detail</a></button>
                <!-- <button class="button">RENT BIKE</button> -->
                <!-- Other elements are omitted for brevity -->
            </div>

        <?php endforeach; ?>
    </div>

    <button class="custom-button" style="align-items: center;"><a href="index.php">Go home page</a></button>
</body>

</html>