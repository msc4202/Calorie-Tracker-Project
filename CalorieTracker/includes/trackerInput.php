<?php

    include_once 'database.php';
    session_start();

    $date = $_POST['date'];
    $weight = $_POST['weight'];
    $totalCalories = $_POST['totalCalories'];

    // Get the user ID of the logged-in user
    $userID = $_SESSION["userid"];

    // Insert the data into the "dailyTrack" table
    $insertQuery = "INSERT INTO dailyinput (dateOf, totalCalories, dailyWeight, user_id) VALUES ('$date', '$totalCalories', '$weight', '$userID');";
    mysqli_query($conn, $insertQuery);

    // Redirect back to the tracker page with a success message
    header("Location: ../tracker.php?submit=success");
    exit();


