<!DOCTYPE html>
<html>
<head>
  <title>Calorie Tracker - Create New Account</title>
  <link rel="stylesheet" href="CalorieTracker.css">
</head>
<body>
  <div class="create-account-container">
  <form class="create-account-form" action="includes/signup.php" method="Post">
    <h1>Create New Account</h1>
      <input type="username" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type ="submit" name="submit-button">Submit</button>
      <a href="Dashboard.php"><button type = "button" id="dash">Back to Dashboard</button></a>
  </form>
  </div>
</body>
</html>
