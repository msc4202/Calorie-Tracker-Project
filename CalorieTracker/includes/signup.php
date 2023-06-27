<?php
  
  include_once 'database.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM loginsystem WHERE nameuser = '$username';";
    $result = mysqli_query($conn, $query);
    
    // Check if any matching record was found
    if (mysqli_num_rows($result) > 0) {
      header("Location:../CreateNew.php?username_already_exists");
      exit();
    }
    else{
      $addaccount = "INSERT into loginsystem (nameuser, secretpassword) VALUES ('$username', '$password');";
      mysqli_query($conn, $addaccount);

      header("Location:../CreateNew.php?signup=success");
      exit();
    }