<!DOCTYPE html>
<html>

<head>
    <title>Payment Method</title>
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
            <h1 style="font-size: 48px; color: #8c36c0;">PAYMENT CARD</h1>
        </div>
        <div style="margin: 0 auto; width: 423px; border: 3px solid #FAE715; border-radius: 15px; padding: 40px;">
            <form>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Owner</label>
                    <input type="text" id="cardOwner" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                </div>
                <div style="margin-bottom: 20px;">
                    <label style="font-size: 15px; color: #505050;">Card Number</label>
                    <input type="text" id="cardNumber" placeholder="MM/YYYY" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    <img src="icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;">
                </div>
                <div style="display: flex; margin-bottom: 20px;">
                    <div style="flex: 1; margin-right: 10px;">
                        <label style="font-size: 15px; color: #505050;">EXP Date</label>
                        <input type="text" id="expDate" style="width: 151px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                        <img src="icons/credit_card_icon.png" alt="Credit Card Icon" style="width: 24px; height: 24px; margin-left: 10px;">
                    </div>
                    <div style="flex: 1;">
                        <label style="font-size: 15px; color: #505050;">Security Code</label>
                        <input type="text" id="securityCode" style="width: 168px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" require>
                    </div>
                </div>
            </form>

            <div style="text-align: center;">
                <button id="paymentCancelButton" style="width: 52px; height: 52px; border: 2px solid #8C36C0; border-radius: 6px; background-color: #FFFFFF; cursor: pointer;">
                    <!-- Add button content here -->
                </button>
                <img id="backButtonImage" src="rotate-ccw.png" alt="Back Button" style="width: 24px; height: 24px; cursor: pointer;">
            </div>

            <div style="text-align: center; margin-top: 20px;">
                <button id="paymentConfirmButton" style="background-color: #8C36C0; border-radius: 6px; background-radius: 6px; color: white; font-family: Arial; font-size: 18px; cursor: pointer;">
                    PROCESS PAYMENT
                </button>
            </div>
            <p id="errorText" style="color: RED; text-align: center; font-family: 'Arial Bold'; font-size: 18px; display: none;">Text</p>
        </div>

    </div>
</body>

</html>