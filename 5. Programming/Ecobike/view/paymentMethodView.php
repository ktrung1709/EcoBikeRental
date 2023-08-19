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

        #paymentConfirmButton {
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

        #paymentConfirmButton:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        #paymentConfirmButton:focus {
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
    <div style="background-color: #FFFFFF; height: 768px; width: 1366px;">
        <div style="text-align: center; margin-top: 170px;">
            <h1 style="font-size: 48px; color: #6699CC;">PAYMENT CARD</h1>
        </div>
        <div style="margin: 0 auto; width: 423px; border: 3px solid #FFCC99; border-radius: 15px; padding: 40px;" require>
            <form>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Owner</label>
                    <br>
                    <input type="text" id="cardOwner" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Number</label>
                    <input type="text" id="cardNumber" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    <!-- <img src="icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;"> -->
                </div>
                <div style="display: flex; margin-bottom: 20px;">
                    <div style="flex: 1; margin-right: 10px;">
                        <label style="font-size: 15px; color: #505050;">EXP Date</label>
                        <input type="text" id="expDate" style="width: 151px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" placeholder="MM/YYYY" require>
                        <!-- <img src="icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;"> -->
                    </div>
                    <div style="flex: 1;">
                        <label style="font-size: 15px; color: #505050;">Security Code</label>
                        <input type="text" id="securityCode" style="width: 168px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    </div>
                </div>
                <input type="hidden" name="bikeId" value="<?php echo $bikeId; ?>">
                <input id="paymentConfirmButton" type="submit" value="Process Payment">
            </form>

            <!-- <div style="text-align: center; margin-top: 20px;">
                <button id="paymentConfirmButton">
                    CONTINUE
                </button>
            </div> -->
            <p id="errorText" style="color: RED; text-align: center; font-family: 'Arial Bold'; font-size: 18px; display: none;">Text</p>
        </div>

    </div>

</body>

</html>