<!DOCTYPE html>
<html>

<head>
    <title>Pay Deposit Transaction</title>
    <style>
        /* Your CSS styles here */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .container {
            position: relative;
            background-color: #FFFFFF;
            height: 768px;
            width: 1366px;
        }

        .payment-box {
            position: absolute;
            left: 198px;
            top: 132px;
            border: 3px solid #FF9966;
            border-radius: 15px;
            width: 970px;
            height: 570px;
        }

        .bike-image {
            position: absolute;
            left: 75px;
            top: 52px;
            width: 300px;
        }

        .grid-pane {
            position: absolute;
            left: 90px;
            top: 284px;
            display: grid;
            grid-template-columns: auto auto;
            grid-template-rows: repeat(4, 30px);
            gap: 10px;
        }

        h2 {
            margin-bottom: 20px;
        }

        .info-label {
            opacity: 0.6;
            font-family: Arial;
            font-size: 18px;
        }

        .info-value {
            opacity: 0.9;
            font-family: 'Arial Bold Italic';
            font-size: 18px;
            color: #0099CC;
        }

        .separator {
            position: absolute;
            left: 312px;
            top: 435px;
            width: 163px;
            height: 1px;
            background-color: #c7c7c7;
        }

        .amount-box {
            position: absolute;
            left: 541px;
            top: 378px;
            display: flex;
            align-items: center;
        }

        .amount-label {
            opacity: 0.6;
            font-size: 24px;
        }

        .amount-value {
            color: #0099CC;
            font-family: 'System Bold';
            font-size: 24px;
            text-align: right;
            margin-left: auto;
        }

        .buttons-box {
            position: absolute;
            left: 535px;
            top: 452px;
            display: grid;
            grid-template-columns: auto auto;
            gap: 10px;
        }

        .button {
            border-radius: 6px;
            cursor: pointer;
            font-family: 'Arial Bold';
            font-size: 18px;
            text-align: center;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
        }

        .cancel-button {
            border: 2px solid #8C36C0;
            background-color: #FFFFFF;
        }

        /* .confirm-button {
            background-color: #8C36C0;
        } */
        a {
            text-decoration: none;
            color: black;
        }
        .confirm-button {
            background-color: #6699CC;
            border: none;
            color: black;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 30px;
            margin-left: 20px;
            align-items: center;
        }

        .confirm-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .confirm-button:focus {
            outline: none;
        }

        .loading-indicator {
            width: 40px;
            height: 40px;
            margin-left: 10px;
        }

        .card-info {
            position: absolute;
            left: 535px;
            top: 74px;
        }

        .card-field {
            border: 2px solid #AAAAAA;
            border-radius: 3px;
            width: 343px;
            height: 36px;
            font-size: 15px;
            padding: 5px 10px;
        }

        .card-label {
            font-size: 15px;
            color: #505050;
            margin-bottom: 5px;
        }

        .error-text {
            color: red;
            font-family: 'Arial Bold';
            font-size: 18px;
            text-align: center;
            width: 423px;
            visibility: hidden;
            margin-top: 10px;
        }

        .navbar {
            position: absolute;
            top: 0;
            background-color: #8c36c0;
            width: 1366px;
            height: 60px;
            box-shadow: 0px 0px 0px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <h1>Pay Deposit Transaction</h1>
    <div class="container">
        <br>
        <form action="requestHandler.php?request=processDeposit" method="post">
            <div class="payment-box">

                <img src="<?php echo $bike->getImageURL(); ?>" alt="" class="bike-image">
                <div class="grid-pane">
                    <!-- <h2>Bike Information</h2> -->
                    <br>
                    <div class="field">
                        <label for="bikeId" class="info-label">Bike ID:</label>
                        <input readonly type="text" id="bikeId" class="info-value" name="bikeId" value="<?php echo $bike->getId(); ?>">
                    </div>
                    <br>
                    <div class="field">
                        <label for="deposit" class="info-label">Deposit:</label>
                        <input readonly type="text" id="deposit" class="info-value" name="deposit" value="<?php echo $bike->getDeposit(); ?>">
                        VND
                    </div>


                </div>
                <div class="buttons-box">
                <button  class="submit-btn button confirm-button " type="submit"><a
                href="requestHandler.php?request=paymentMethod">
                Cancel Payment
                         </a>
                       </button>
                    <button class="submit-btn button confirm-button " type="submit">Confirm Pay Deposit</button>
                </div>
                <div class="card-info">
                    <h2>Card Information</h2>
                    <div class="field">
                        <label for="cardNum" class="card-label">Card Id:</label>
                        <br>
                        <input readonly type="text" id="cardId" class="card-field" name="cardId" value="<?php echo $card1->getId(); ?>">
                    </div>
                    <div class="field">
                        <label for="cardNum" class="card-label">Card Number:</label>
                        <input type="text" id="cardNum" class="card-field" name="cardNum" value="<?php echo $card1->getCardNum(); ?>" readonly>
                    </div>
                    <div class="field">
                        <label for="cardOwner" class="card-label">Card Owner:</label>
                        <br>
                        <input type="text" id="cardOwner" class="card-field" name="cardOwner" value="<?php echo $card1->getCardOwner(); ?>" readonly>
                    </div>
                    <div class="field">
                        <label for="expDate" class="card-label">Expiration Date:</label>
                        <input type="text" id="expDate" class="card-field" name="expDate" value="<?php echo $card1->getExpDate(); ?>" readonly>
                    </div>

                </div>



            </div>

        </form>

    </div>
    <!-- < class="container"> -->
    <!-- <h1>Pay Deposit Transaction</h1> -->





</body>

</html>