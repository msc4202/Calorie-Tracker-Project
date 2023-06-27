<?php

    include_once 'database.php';
    session_start();

    $calorieGoal = $_POST['calorie-goal'];
    $weightLossGoal = $_POST['weight-loss-goal'];
    $weightGainGoal = $_POST['weight-gain-goal'];

    // Get the user ID of the logged-in user
    $userID = $_SESSION["userid"];

    $query = "SELECT * FROM goals WHERE users_id = '$userID'";
    $result = mysqli_query($conn, $query);

    // Insert the data into the "dailyTrack" table
    if(mysqli_num_rows($result) === 0){
    $insertQuery = "INSERT INTO goals (calorieGoal, weightLossGoal, weightGainGoal, users_id) VALUES ('$calorieGoal', '$weightLossGoal', '$weightGainGoal', '$userID');";
    mysqli_query($conn, $insertQuery);
    }
    else{
        $updateQuery = "UPDATE goals SET calorieGoal='$calorieGoal', weightLossGoal='$weightLossGoal', weightGainGoal='$weightGainGoal' WHERE users_id='$userID';";
        mysqli_query($conn, $updateQuery);
    }

    // Redirect back to the tracker page with a success message
    header("Location: ../progress.php?submit=success");
    exit();
