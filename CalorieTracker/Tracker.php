<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Calorie Tracker - Tracker</title>
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
      <span class="page-title">Tracker</span>
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
    <h1>Calorie Tracker</h1>
    <form id="calorie-tracker-form" action="includes/trackerInput.php" method="Post">
      <label for="date">Date:</label>
      <input type="date" id="date" name="date">
      
      <div class="food-row">
        <input type="text" class="food-input" placeholder="Food Item">
        <input type="number" class="calorie-input" name="calories[]" placeholder="Calories">
      </div>

      <div id="food-entries">
        <!-- Additional food rows will be added here -->
      </div>

      <div class="add-more" id="add-more-btn">
        <span>+</span> Add More
      </div>

      <div>
        <label for="weight">Weight:</label>
        <input type="number" id="weight" name="weight" placeholder="Weight (in lb)">
      </div>

      <div>
        <div class="calorie-total" name="calorie-total" id="calorie-total-box"></div>
      </div>

      <?php
        if(isset($_SESSION["userid"])){
          echo "<button type ='button' id='total-button'>Calculate Total</button>";
          echo "<button type ='submit' name='tracker-submit-button'>Submit</button>";
        }
        else{
          echo "<p>Please log-in to use tracker</p>";
        }
      ?>

    </form>
  </div>

  <script>
    const addMoreButton = document.getElementById("add-more-btn");
    const totalButton = document.getElementById("total-button");
    const foodEntries = document.getElementById("food-entries");
    const calorieTotalBox = document.getElementById("calorie-total-box");

    addMoreButton.addEventListener("click", function () {
      const foodRow = document.createElement("div");
      foodRow.classList.add("food-row");

      const foodInput = document.createElement("input");
      foodInput.type = "text";
      foodInput.classList.add("food-input");
      foodInput.placeholder = "Food Item";

      const calorieInput = document.createElement("input");
      calorieInput.type = "number";
      calorieInput.classList.add("calorie-input");
      calorieInput.placeholder = "Calories";

      foodRow.appendChild(foodInput);
      foodRow.appendChild(calorieInput);
      foodEntries.appendChild(foodRow);
    });

    totalButton.addEventListener("click", function (e) {
      e.preventDefault();

      let totalCalories = 0;

      const calorieInputs = document.querySelectorAll(".calorie-input");

      calorieInputs.forEach(function (input) {
        totalCalories += parseInt(input.value) || 0;
      });

      calorieTotalBox.textContent = "Total Calories: " + totalCalories;
    });

    const calorieTrackerForm = document.getElementById("calorie-tracker-form");

    calorieTrackerForm.addEventListener("submit", function (e) {
      e.preventDefault();

      let totalCalories = 0;

      const calorieInputs = document.querySelectorAll(".calorie-input");

      calorieInputs.forEach(function (input) {
        totalCalories += parseInt(input.value) || 0;
      });

      const totalCaloriesInput = document.createElement("input");
      totalCaloriesInput.type = "hidden";
      totalCaloriesInput.name = "totalCalories";
      totalCaloriesInput.value = totalCalories;
      calorieTrackerForm.appendChild(totalCaloriesInput);

      // Submit the form
      calorieTrackerForm.submit();
    });
  </script>
</body>
</html>