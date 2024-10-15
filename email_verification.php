<?php
    session_start();
    include 'db.php';
    $code = $_GET['code'];
    
    // Check if the code exists in the database
    $sql = "SELECT * FROM users WHERE activationcode = '$code'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Check if the user is already verified
        if ($user['status'] == 1) {
            // Update the user's status to 1 (verified)
            $update = "UPDATE users SET status = 2, activationcode = NULL WHERE activationcode = '$code'";
             if ($conn->query($update) == TRUE) {
                $_SESSION['messages'] = "Your email has been verified successfully. Please login now";
                header('Location: index.php');
                exit();
             }
            
        } else {
            $_SESSION['messages'] = "This email is already verified.";
            header('Location: index.php');
            exit();
        }
    } else {
        echo "Invalid or expired verification code.";
    }

$conn->close();
?>