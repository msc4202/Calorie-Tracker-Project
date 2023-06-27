<?php

    include_once 'database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM loginsystem WHERE nameuser = '$username';";
    $result = mysqli_query($conn, $query);

    // Check if any matching record was found
    if (mysqli_num_rows($result) > 0) {
        // Fetch the record
        $row = mysqli_fetch_assoc($result);
        
        // Verify the password
        if ($password === $row['secretpassword']) {
            // Password is correct
            // Perform further actions or redirect to a success page
            session_start();
            $_SESSION["userid"] = $row['id'];
            $_SESSION["username"] = $row['nameuser'];
            header("Location:../Dashboard.php?successfullogin");
            exit();
        } else {
            // Password is incorrect
            // Display an error message or redirect to a login failure page
            header("Location:../LogInPage.php?error=incorrect_password");
            exit();
        }
    } 
    else {
        // No matching record found
        // Display an error message or redirect to a login failure page
        header("Location:../LogInPage.php?error=user_not_found");
        exit();
        }
    


    