<!DOCTYPE html>
<html>
<head>
    <title>Pay Deposit Transaction</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="invoice-container">
        <h1>Pay Deposit Transaction</h1>

        <form action="requestHandler.php?request=processDeposit" method="post">
            <h2>Bike Information</h2>
            <div class="field">
                <label for="bikeId">Bike ID:</label>
                <input type="text" id="bikeId" name="bikeId" value="<?php echo $bike->getId(); ?>" >
            </div>
            <div class="field">
                <label for="deposit">Deposit:</label>
                <input type="text" id="deposit" name="deposit" value="<?php echo $bike->getDeposit(); ?>" >
                VND
            </div>

            <h2>Card Information</h2>
            <div class="field">
                <label for="cardNum">Card Id:</label>
                <input type="text" id="cardId" name="cardId" value="<?php echo $card1->getId(); ?>" >
            </div>
            <div class="field">
                <label for="cardNum">Card Number:</label>
                <input type="text" id="cardNum" name="cardNum" value="<?php echo $card1->getCardNum(); ?>" disabled>
            </div>
            <div class="field">
                <label for="cardOwner">Card Owner:</label>
                <input type="text" id="cardOwner" name="cardOwner" value="<?php echo $card1->getCardOwner(); ?>" disabled>
            </div>
            <div class="field">
                <label for="expDate">Expiration Date:</label>
                <input type="text" id="expDate" name="expDate" value="<?php echo $card1->getExpDate(); ?>" disabled>
            </div>

            
            <button class="submit-btn" type="submit">Confirm Pay Deposit</button>
        </form>
    </div>
</body>
</html>
