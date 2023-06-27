<?php
  include_once 'includes/database.php';
  session_start();

  // Get the user ID of the logged-in user
  if(isset($_SESSION["userid"])){
    $userID = $_SESSION["userid"];

    // Retrieve the last 30 dailyInputs for the user from the database
    $query = "SELECT * FROM dailyinput WHERE user_id = '$userID' ORDER BY dateOf DESC LIMIT 30";
    $result = mysqli_query($conn, $query);

    // Store the retrieved dailyInputs in an array
    $dailyInputs = [];
    while ($row = mysqli_fetch_assoc($result)) {
      $dailyInputs[] = $row;
    }

    // Get users current goals
    $query = "SELECT * FROM goals WHERE users_id = '$userID'";
    $result = mysqli_query($conn, $query);
    $goals = mysqli_fetch_assoc($result);
  }
?>

<!DOCTYPE html>
<html>
<head>
  <title>Calorie Tracker - Progress</title>
  <link rel="stylesheet" type="text/css" href="CalorieTracker.css">
</head>
<body>
  
<!-- Sidebar -->
  <div class="sidebar">
    <h1>CalorieCore</h1>
    <ul>
      <li><a href="dashboard.php">Dashboard</a></li>
      <li><a href="tracker.php">Tracker</a></li>
      <li><a href="progress.php">Progress</a></li>
    </ul>
  </div>

  <!-- Top bar -->
  <div class="top-bar">
    <div class="top-bar-left">
      <span class="page-title">Progress</span>
    </div>
    <div class="top-bar-right">
       
    <?php
        if(isset($_SESSION["userid"])){
          echo "<a href='includes/logout.php'>Log Out</a>";
        }
        else{
          echo "<a href='LogInPage.php'>Log-In</a>";
        }
      ?>
    
    </div>
  </div>


  <!-- Content -->
  <div class="content">
    <h1>Calorie Tracker Progress</h1>
    <div class="table-container">
        <?php
          if(isset($_SESSION["userid"])){
            echo "<table>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Date</th>";
            echo "<th>Total Calories</th>";
            echo "<th>Weight</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            
            // Retrieve the last 30 daily inputs from the database
            $query = "SELECT * FROM dailyinput WHERE user_id = '$userID' ORDER BY dateOf DESC LIMIT 30";
            $result = mysqli_query($conn, $query);

            // Display each daily input in a table row
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>".$row['dateOf']."</td>";
              echo "<td>".$row['totalCalories']."</td>";
              echo "<td>".$row['dailyWeight']."</td>";
              echo "</tr>";
            }
          }
          else{
            echo "<p>Please log-in to see progress</p>";
          }
        ?>
      </tbody>
    </table>
  </div>
    
    <div class="goals-section">
        <div class="current-goals-section">
        <h2>Current Goals:</h2>
        <?php
        if (!empty($goals)) {
            echo "<p>Calorie Goal: " . $goals['calorieGoal'] . "</p>";
            echo "<p>Weight Loss Goal: " . $goals['weightLossGoal'] . "</p>";
            echo "<p>Weight Gain Goal: " . $goals['weightGainGoal'] . "</p>";
        } else {
            echo "<p>No goals set yet.</p>";
        }
        ?>
        </div>
      <h3>Update Goals:</h3>
      <form id="goals-form" action="includes/goals.php" method="Post">
        <div>
          <label for="calorie-goal">Calorie Goal:</label>
          <input type="number" id="calorie-goal" name="calorie-goal" placeholder="Enter calorie goal">
        </div>
        <div>
          <label for="weight-loss-goal">Weight Loss Goal:</label>
          <input type="number" id="weight-loss-goal" name="weight-loss-goal" placeholder="Enter weight loss goal (in lb)">
        </div>
        <div>
          <label for="weight-gain-goal">Weight Gain Goal:</label>
          <input type="number" id="weight-gain-goal" name="weight-gain-goal" placeholder="Enter weight gain goal (in lb)">
        </div>
        
        <?php
        if(isset($_SESSION["userid"])){
        echo "<button type ='submit' name='goals-button'>Submit</button>";
        }
        ?>

      </form>
    </div>
  
</div>
</body>
</html>

