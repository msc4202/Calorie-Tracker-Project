<?php
  include_once 'includes/database.php';
  session_start();

  // Get the user ID of the logged-in user
  if (isset($_SESSION["userid"])) {
    $userID = $_SESSION["userid"];

    // Retrieve the last 7 days' total calories for the user from the database
    $query = "SELECT DATE(dateOf) AS day, SUM(totalCalories) AS total FROM dailyinput WHERE user_id = '$userID' GROUP BY DATE(dateOf) ORDER BY dateOf DESC LIMIT 7";
    $result = mysqli_query($conn, $query);

    // Store the retrieved data in arrays
    $labels = [];
    $calorieData = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['day'];
        $calorieData[] = $row['total'];
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
  <title>Calorie Tracker - Dashboard</title>
  <link rel="stylesheet" type="text/css" href="CalorieTracker.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
      <span class="page-title">Dashboard</span>
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
    <h1>Calorie Tracker Dashboard</h1>
    <p>Welcome to your calorie tracker dashboard!</p>
    <h2>Your Current Goals:</h2>
        <?php
        if (!empty($goals)) {
            echo "<p>Calorie Goal: " . $goals['calorieGoal'] . "</p>";
            echo "<p>Weight Loss Goal: " . $goals['weightLossGoal'] . "</p>";
            echo "<p>Weight Gain Goal: " . $goals['weightGainGoal'] . "</p>";
        } else {
            echo "<p>No goals set yet.</p>";
        }
        
        if(isset($_SESSION["userid"])){
          echo "<div class='line-chart-header'>Your Calorie Chart:</div>";
          echo "<canvas id='calorie-chart'></canvas>";
        } else {
            echo "<p>Login to view your Chart</p>";
      }

        ?>
  </div>
  <script>
    // Create the line chart using Chart.js
    var calorieChart = new Chart(document.getElementById('calorie-chart'), {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>, // Pass the labels here
                datasets: [{
                    label: 'Total Calories from the last 7 days you tracked your calories',
                    data: <?php echo json_encode($calorieData); ?>, // Pass the total calories data here
                    backgroundColor: 'rgba(0, 123, 255, 0.3)',
                    borderColor: 'rgba(0, 123, 255, 1)',
                    borderWidth: 1,
                    fill: 'start',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Dates',
                        },
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Total Calories',
                        },
                        suggestedMin: 0, // Adjust the minimum value if needed
                    }
                }
            }
        });
</script>
</body>
</html>
