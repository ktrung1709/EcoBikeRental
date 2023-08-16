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
    <h1>Payment Method</h1>
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

    </form>

    

  
    </div>
</body>

</html>