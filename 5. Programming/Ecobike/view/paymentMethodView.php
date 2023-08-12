<!DOCTYPE html>
<html>

<head>
    <title>Payment Method</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            overflow-x: hidden;
        }

        .all-button {
            display: flex;
            flex-direction: row;
            text-align: center;
        }

        .custom-button {
            background-color: #CC99CC;
            text-align: center;
            position: relative;
            /* left: 93px; */
            /* top: 280px;  */
            height: 44px;
            width: 200px;
            border: none;
            /* background-color: #6699CC; */
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            margin-right: 8px;

        }

        .button {
            text-align: center;
            position: relative;
            /* left: 93px; */
            /* top: 280px;  */
            height: 44px;
            width: 200px;
            border: none;
            background-color: #6699CC;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-family: Arial;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            /* margin-right: 8px; */
        }

        .button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <!-- <h1>Payment Method</h1>
    <form action="requestHandler.php?request=processPayment" method="post">
        <label for="cardNum">Card Number:</label>
        <input type="text" name="cardNum" id="cardNum" required><br>

        <label for="cardOwner">Card Owner:</label>
        <input type="text" name="cardOwner" id="cardOwner" required><br>

        <label for="securityCode">Security Code:</label>
        <input type="password" name="securityCode" id="securityCode" required><br>

        <label for="expDate">Expiration Date:</label>
        <input type="text" name="expDate" id="expDate" placeholder="MM/YYYY" required><br>

         <input type="hidden" name="bikeId" value="<?php echo $bikeId; ?>"> 
        <input type="submit" value="Process Payment">
    </form> -->
    <div style="position: relative; background-color: #6699CC; height: 60px; width: 1366px;">
        <img id="logo" src="view/image/LOGO.png" alt="Logo" style="position: absolute; top: 0; left: 0; cursor: hand; width: 176px; height: 60px;">

    </div>

    <div style="background-color: #FFFFFF; height: 768px; width: 1366px;">
        <div style="text-align: center; margin-top: 170px;">
            <h1 style="font-size: 48px; color: #6699CC;">PAYMENT CARD</h1>
        </div>
        <div style="margin: 0 auto; width: 423px; border: 3px solid #FF9999; border-radius: 15px; padding: 40px;">
            <form>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Owner</label>
                    <input type="text" id="cardOwner" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Number</label>
                    <input type="text" id="cardNumber" placeholder="MM/YYYY" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    <img src="view/icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;">
                </div>
                <div style="display: flex; margin-bottom: 20px;">
                    <div style="flex: 1; margin-right: 10px;">
                        <label style="font-size: 15px; color: #505050;">EXP Date</label>
                        <input type="text" id="expDate" style="width: 151px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                        <img src="view/icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;">
                    </div>
                    <div style="flex: 1;">
                        <label style="font-size: 15px; color: #505050;">Security Code</label>
                        <input type="text" id="securityCode" placeholder="CVV" style="width: 168px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    </div>
                </div>
            </form>

            <!-- <div style="text-align: center;">
                <button id="paymentCancelButton" style="width: 52px; height: 52px; border: 2px solid #8C36C0; border-radius: 6px; background-color: #FFFFFF; cursor: pointer;">
                    !-- Add button content here --
                </button>
                <img id="backButtonImage" src="rotate-ccw.png" alt="Back Button" style="width: 24px; height: 24px; cursor: pointer;">
            </div> -->

            <div class="all-button">
                <div style="text-align: center; margin-top: 20px;">
                    <button class="custom-button">
                        BACK TO PREVIOUS PAGE
                    </button>
                </div>
                <div style="text-align: center; margin-top: 20px;">
                    <button class="button">
                        PROCESS PAYMENT
                    </button>
                </div>
            </div>
            <p id="errorText" style="color: RED; text-align: center; font-family: 'Arial Bold'; font-size: 18px; display: none;">Text</p>
        </div>

    </div>
</body>

</html>