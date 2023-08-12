<!DOCTYPE html>
<html>
<head>
    <title>Payment Method</title>
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
        <input type="submit" value="Process Payment">
    </form>
</body>
</html>
