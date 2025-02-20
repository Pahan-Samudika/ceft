<?php

include_once("../../connection.php");

// Handle form actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Get the form data
    $from_acc = htmlentities($_POST['fa']);
    $beni_name = htmlentities($_POST['ta']);
    $amount = htmlentities($_POST['amnt']);
    $description = htmlentities($_POST['sad']);

    // Check if the account balance is sufficient
    $query = "SELECT balance FROM bankAccount WHERE acc_no = '$from_acc'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $balance = $row['balance'];

    if ($balance < $amount) {
        // Insufficient balance
        header("Location: ../../../dashboard/transfer.php?insufficient=true");
        exit();
    }

    // Deduct the amount from the sender's account
    $query = "UPDATE bankAccount SET balance = balance - '$amount' WHERE acc_no = '$from_acc'";
    $result = mysqli_query($conn, $query);


    // Transaction record
    $query = "INSERT INTO transaction (
                         from_acc, 
                         beni_name,
                         amount,
                         description,
                         type
                         ) VALUES ('$from_acc', '$beni_name', '$amount', '$description', 'bill payment')";

    // Execute the query
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Success
        header("Location: ../../../dashboard/transfer.php?succeed=true");
    } else {
        // Failure
//        header("Location: ../../../dashboard/transfer.php?succeed=false");
        echo mysqli_error($conn);
    }

    // Close the connection
    

}
?>