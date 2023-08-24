<!DOCTYPE html>
<html>

<head>
    <title>Invoice Screen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            display: flex;
            justify-content: space-between;
            margin: 40px;
            margin-left: 5px;
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            padding: 20px 0;
        }

        .invoice-section {
            flex: 1;
            /* padding: 0 20px; */
        }

        .invoice-section img {
            max-width: 100%;
        }

        .invoice-header {
            /* background-color: #800080; */
            text-align: center;
            padding: 20px 0;
            color: #6699CC;
        }

        .invoice-image {
            width: 350px;
            height: 350px;
            text-align: center;
            padding: 20px 0;
            margin-left: 50px;
        }

        .invoice-details {
            /* margin-top: 20px; */
            margin: 20px;
            margin-left: 0px;
            margin-right: 55px;
        }

        .invoice-details table {
            width: 100%;
            margin-bottom: 20px;
        }

        .invoice-details th {
            text-align: left;
            /* Căn lề trái */
            font-weight: bold;
            padding: 15px;
        }

        .invoice-details td {
            text-align: right;
            /* Căn lề phải */
            padding: 5px;
        }

        .returns-section {
            text-align: center;
            padding: 20px 0;
        }

        /* .confirm-button {
            background-color: #800080;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
        } */

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
        }

        .confirm-button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .confirm-button:focus {
            outline: none;
        }

        .payment-section {
            /* background-color: #800080; */
            color: #800080;
            text-align: center;
            padding: 20px 0;
        }

        .payment-section input[type="text"],
        .payment-section input[type="password"] {
            width: 100%;
            padding: 5px;
            margin: 3px 0;
        }

        .different-card-label {
            display: inline-block;
            margin-right: 10px;
        }

        .normal-label {
            margin-top: 20px;
            text-align: left;
            /* Căn lề trái */
            color: black;
        }
    </style>
    <script>
         window.addEventListener('DOMContentLoaded', function() {
        const confirmButton = document.getElementById('confirmButton');

        confirmButton.addEventListener('click', function() {
            // Display JavaScript notification on successful form submission
            confirmButton.disabled = true; // Disable button to prevent multiple submissions
            setTimeout(function() {
                alert("Transaction Successful! You will be redirected to the main page.");
                window.location.href = "mainPage.php";
            }, 500); // Delay for 0.5 seconds before showing the notification and redirecting
        });
    });
        window.addEventListener('DOMContentLoaded', function() {
            const useDifferentCardCheckbox = document.getElementById('useDifferentCard');
            const paymentInputs = document.querySelectorAll('.payment-section input[type="text"], .payment-section input[type="password"]');

            paymentInputs.forEach(input => {
                input.disabled = !useDifferentCardCheckbox.checked;
            });

            useDifferentCardCheckbox.addEventListener('change', function() {
                paymentInputs.forEach(input => {
                    input.disabled = !this.checked;
                });
            });
        });
    </script>
</head>

<body>
<form method="post" action="requestHandler.php?request=processInvoice">
    <div class="invoice-container">
        <div class="invoice-section">
            <div class="invoice-header">
                <h1>INVOICE</h1>
            </div>
            <div class="invoice-image">
                <img src="<?php echo $bike->getImageURL(); ?>" alt="Bike Image">
            </div>
        </div>
        <div class="invoice-section">
            <div class="invoice-details">
                <table>
                    <tr>
                        <th>DEPOSIT CARD NUMBER:</th>
                        <td>
                       <?php echo $card->getCardNum();
                            ?>
                           
                        </td>
                    </tr>
                    <tr>
                        <th>START TIME:</th>
                        <td>
                            <?php echo $session->getStartTime()->format('d-m-Y H:i:s a'); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>END TIME:</th>
                        <td>
                            <?php
                            if ($session->getEndTime() !== null) {
                                echo $session->getEndTime()->format('d-m-Y H:i:s a');
                            } else {
                                echo "SESSION HAS NOT ENDED";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>LENGTH:</th>
                        <td>
                            <?php
                            if ($session->getEndTime() !== null) {
                                $startTime = $session->getStartTime();
                                $endTime = $session->getEndTime();
                                $interval = $startTime->diff($endTime);
                                echo $interval->format('%d days, %H hours, %i minutes, %s seconds');
                            } else {
                                echo "SESSION HAS NOT ENDED";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>DEPOSIT:</th>
                        <td>
                            <span style="color: #008000;"><?php echo $bike->getDeposit(); ?></span>
                            <input type="hidden" name="deposit" value="<?php echo $bike->getDeposit(); ?>">
                        </td>
                    </tr>
                    <tr>
                        <th>TOTAL FEES:</th>
                        <td>
                            <span style="color: red;">150000</span>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="returns-section">
                <h2>RETURNS</h2>
                <p>
                    <span style="font-weight: bold; color: black;"><?php
            $difference = 150000 - $bike->getDeposit();
            echo $difference;
        ?></span> (Returns:
                    <span style="color: red;">150000</span> -
                    <span style="color: #008000;"><?php echo $bike->getDeposit(); ?></span>)
                </p>

                <input type="hidden" name="difference" value="<?php echo $difference; ?>">
                <input type="hidden" name="cardOwner" placeholder="Card Owner" value="<?php echo $card->getCardOwner(); ?>">
                <button type="submit" class="confirm-button">CONFIRM</button>
            </div>
        </div>
        <div class="invoice-section ">
            <h1 style="color: #6699CC;">PAYMENT CARD</h1>
            <div class="normal-label">Card Owner</div>
            <input type="text" name="card_owner" placeholder="Card Owner" value="<?php echo $card->getCardOwner(); ?>">
            <div class="normal-label">Card Number</div>
            <input type="text" name="card_number" placeholder="Card Number" value="<?php echo $card->getCardNum(); ?>">
            <div class="normal-label">EXP Date</div>
            <input type="text" name="expDate" placeholder="EXP Date" value="<?php echo $card->getExpDate(); ?>">
            <div class="normal-label">Security Code</div>
            <input type="password" name="security_code" placeholder="Security Code" value="<?php echo $card->getSecurityCode(); ?>">
            <br>
            <input type="checkbox" id="useDifferentCard" name="use_different_card">
            <label class="normal-label" for="useDifferentCard">USE DIFFERENT CARD TO RETURN MONEY</label>
        </div>
    </div>
</form>

</body>

</html>