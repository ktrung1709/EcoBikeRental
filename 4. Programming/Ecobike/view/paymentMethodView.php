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

        .custom-button {
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
        }

        .custom-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .custom-button:focus {
            outline: none;
        }
    </style>
</head>

<body>
    <div style="background-color: #FFFFFF; height: 768px; width: 1366px;">
        <div style="text-align: center; margin-top: 170px;">
            <h1 style="font-size: 48px; color: #6699CC;">PAYMENT CARD</h1>
        </div>
        <div style="margin: 0 auto; width: 423px; border: 3px solid #FF9966; border-radius: 15px; padding: 40px;">
            <form action="requestHandler.php?request=processPayment" method="post">
                <div style="margin-bottom: 20px;">
                    <label for="cardNum" style="font-size: 15px; color: #505050;">Card Number:</label>
                    <input type="text" name="cardNum" id="cardNumber" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" required><br>
                </div>
                <div style="margin-bottom: 20px;">
                    <label for="cardNum" style="font-size: 15px; color: #505050;">Card Owner:</label>
                    <input type="text" name="cardOwner" id="cardOwner" style="width: 343px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" required><br>
                </div>


                <!-- <label for="cardOwner">Card Owner:</label>
                <input type="text" name="cardOwner" id="cardOwner" required><br> -->
                <div style="display: flex; margin-bottom: 20px;">
                    <div style="flex: 1;">
                        <label for="securityCode" style="font-size: 15px; color: #505050;">Security Code:</label>
                        <input type="password" name="securityCode" id="securityCode" style="width: 168px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" required><br>
                    </div>
                    <div style="flex: 1; margin-right: 10px;">
                        <label for="expDate" style="font-size: 15px; color: #505050;">Expiration Date:</label>
                        <input type="text" name="expDate" id="expDate" placeholder="MM/YYYY" style="width: 151px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" required><br>
                    </div>

                </div>
                <!-- <label for="securityCode">Security Code:</label>
                <input type="password" name="securityCode" id="securityCode" style="width: 151px; height: 36px; border: 2px solid #AAAAAA; border-radius: 3px;" required><br>

                <label for="expDate">Expiration Date:</label>
                <input type="text" name="expDate" id="expDate" placeholder="MM/YYYY" required><br> -->



                <input type="hidden" name="bikeId" value="<?php echo $bikeId; ?>">
                <input class="custom-button" type="submit" value="Process Payment">

            </form>

        </div>

    </div>

</body>

</html>