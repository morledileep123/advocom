<?php 
session_start(); // Ensure it's the first line of the script
include '../db.php';

$order_id = $_GET['oid'];
$rp_payment_id = $_GET['rp_payment_id'];
$rp_signature = $_GET['rp_signature'];
$status = "Success";  // Correct string usage for status

$sql = "SELECT * FROM payment_transaction WHERE order_id = '$order_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $userPay = $result->fetch_assoc();
    
    // Check if the payment status is 'Pending'
    if ($userPay['status'] == 'Pending') {
        // Update the payment details and status
        $updatePay = "UPDATE payment_transaction 
                      SET status = '$status', rp_payment_id = '$rp_payment_id', rp_signature = '$rp_signature' 
                      WHERE order_id = '$order_id' AND status = 'Pending'";

        if ($conn->query($updatePay) === TRUE) {
            $_SESSION['messages'] = "Payment is done";
            header('Location: http://localhost/advocom/services.php');
            exit();
        } else {
            // Handle potential query failure
            $_SESSION['messages'] = "Failed to update payment status.";
            header('Location: http://localhost/advocom/payment/index.php');
            exit();
        }
    } else {
        // If payment is not pending
        $_SESSION['messages'] = "Payment is not done.";
        header('Location: http://localhost/advocom/payment/index.php');
        exit();
    }
} else {
    // If no payment record is found
    $_SESSION['messages'] = "Payment error, something is wrong.";
    header('Location: http://localhost/advocom/payment/index.php');
    exit();
}

$conn->close();
?>