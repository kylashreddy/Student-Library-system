<?php
// Start the session
session_start();

// Set a cookie expiration time of 3 minutes
$cookie_name = "payment_details";
$cookie_expiration = time() + 180; // 3 minutes from now

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Store payment details in a cookie
    $payment_details = [
        'amount' => $_POST['amount'],
        'currency' => $_POST['currency'],
        'status' => 'Pending'
    ];
    setcookie($cookie_name, json_encode($payment_details), $cookie_expiration, "/"); // Set cookie
    // Redirect to the same page to show payment details
    header("Location: payment.php");
    exit();
}

// Check if the cookie is set and not expired
$payment_details = isset($_COOKIE[$cookie_name]) ? json_decode($_COOKIE[$cookie_name], true) : null;

// If the cookie is expired, unset it
if ($payment_details && time() > $cookie_expiration) {
    setcookie($cookie_name, "", time() - 3600, "/"); // Expire the cookie
    $payment_details = null; // Clear the payment details
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .button {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 2px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #45a049; /* Darker green on hover */
        }

        .message {
            margin-top: 20px;
            color: #666;
        }
    </style>
    <script>
        // Function to show the payment done message after 3 minutes
        function showPaymentDoneMessage() {
            alert("Payment is done!");
        }

        // Set a timeout to call the function after 3 minutes (180000 milliseconds)
        setTimeout(showPaymentDoneMessage, 180000);
    </script>
</head>
<body>
    <div class="container">
        <h1>Payment Details</h1>
        <?php if ($payment_details): ?>
            <p>Amount: <?php echo htmlspecialchars($payment_details['amount']); ?> <?php echo htmlspecialchars($payment_details['currency']); ?></p>
            <p>Status: <?php echo htmlspecialchars($payment_details['status']); ?></p>
            <p class="message">Please wait for 3 minutes to see the payment confirmation.</p>
        <?php else: ?>
            <form method="POST" action="">
                <input type="number" name="amount" placeholder="Enter Amount" required>
                <select name="currency" required>
                    <option value="">Select Currency</option>
                    <option value="USD">USD</option>
                    <option value="EUR">EUR</option>
                    <option value="GBP">GBP</option>
                </select>
                <button type="submit" class="button">Submit Payment</button>
            </form>
        <?php endif; ?>
    </div>
</body>
</html>