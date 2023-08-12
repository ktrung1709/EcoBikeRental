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

        #container {
            max-height: 100vh;
            max-width: 100vw;
            background-color: #FFFFFF;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
        }

        #bikeInfoPane {
            margin: 75px 245px;
            padding: 10px;
            background-color: #FFFFFF;
            border-radius: 15px;
            border: 4px solid #c5b60b;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        #bikeInfoText {
            margin-left: 10px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #bikeImage {
            width: 400px;
            height: 300px;
            object-fit: contain;
        }

        #bikeTextSection {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .info-text {
            font-family: Arial;
            font-size: 24px;
            opacity: 0.9;
        }

        .highlight-text {
            color: #8c36c0;
            font-family: "Arial Bold Italic";
        }

        .charge-text {
            color: #16b85ff3;
            font-family: "Arial Bold Italic";
            font-size: 24px;
        }

        #bikeUsage {
            font-family: "Arial Italic";
            font-size: 18px;
            opacity: 0.6;
            text-align: right;
        }

        #bikeComponents {
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(6, auto);
            gap: 10px;
            justify-content: center;
        }

        #batteryIcon,
        #saddleIcon,
        #pedalsIcon,
        #rearSeatIcon,
        #batteryIcon {
            width: 28px;
            height: 28px;
            object-fit: contain;
        }

        #componentNumber {
            font-family: Arial;
            font-size: 24px;
            opacity: 0.6;
            text-align: center;
        }

        #actionButton {
            /* margin-top: 20px; */
            background-color: #8c36c0;
            border-radius: 6px;
            cursor: pointer;
            font-family: "Arial Bold";
            font-size: 24px;
            text-align: center;
            color: white;
            border: none;
            padding: 14px 20px;
            /* margin-bottom: ; */
        }

        #actionButton:focus {
            outline: none;
        }

        #navbar {
            background-color: #8c36c0;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            height: 60px;
            width: 100%;
        }

        a {
            text-decoration: none;
            color: black;
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
            margin-left: 580px;
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <!-- <h1>Bike Details View</h1>
    <p>Bike ID: <?php echo $bike->getId(); ?></p>
    <p>Barcode: <?php echo $bike->getBarcode(); ?></p>
    <p>Type: <?php echo $bike->getBikeType(); ?></p>
    <p>Dock ID: <?php echo $bike->getDockId(); ?></p> -->
    <!-- Display other bike details here -->
    <!-- <div id="navbar"></div> -->
    <div style="position: relative; background-color: #8C36C0; height: 60px; width: 1366px;">
        <img id="logo" src="view/image/LOGO.png" alt="Logo" style="position: absolute; top: 0; left: 0; cursor: hand; width: 176px; height: 60px;">
        
    </div>
    <div id="container">
        <div id="bikeInfoPane">
            <!-- <img id="bikeImage" src="" alt="Bike Image"> -->
            <img id="bikeImage" src="<?php echo $bike->getImageURL(); ?>" alt="Bike Image">
            <div id="bikeTextSection">
                <div id="bikeInfoText">
                    <span class="info-text"><span class="highlight-text">BIKE CODE:</span> <?php echo $bike->getId(); ?></span>
                    <span class="info-text"><span class="highlight-text">BARCODE CODE:</span> <?php echo $bike->getBarcode(); ?></span>
                    <!-- <span class="info-text"><span class="highlight-text">LOCATION:</span> DOCK NAME</span> -->
                    <span class="info-text"><span class="highlight-text">DEPOSIT:</span> <?php echo $bike->getDeposit(); ?> VND</span>
                    <span class="info-text charge-text"><span class="highlight-text">CHARGE:</span> <?php echo $bike->getCharge(); ?> VND/h</span>
                    <!-- <span id="bikeUsage" class="info-text">6 HOURS REMAINING</span> -->
                </div>
                <div id="bikeComponents">

                    <img id="saddleIcon" src="view/icons/saddle_icon.png" alt="Saddle Icon">

                    <span id="componentNumber"><?php echo $bike->getSaddle(); ?></span>
                    <img id="pedalsIcon" src="view/icons/pedals_icon.png" alt="Pedals Icon">
                    <span id="componentNumber"><?php echo $bike->getPairOfPedals(); ?></span>
                    <img id="rearSeatIcon" src="view/icons/rear_seat_icon.png" alt="Rear Seat Icon">
                    <span id="componentNumber"><?php echo $bike->getRearSeat(); ?></span>
                    <!-- <img id="batteryIcon" src="icons/battery_icon.png" alt="Battery Icon">
                    <span id="componentNumber">75%</span> -->
                </div>
            </div>
        </div>
        <button id="actionButton">RENT NOW</button>

    </div>
    <button class="custom-button" style="align-items: center;"><a href="index.php">Go home page</a></button>
</body>

</html>