<!DOCTYPE html>
<html>
<head>
  <title>Calorie Tracker - Login</title>
  <link rel="stylesheet" type="text/css" href="CalorieTracker.css">
</head>
<body>
  <div class="login-container">
    <h1>Log In</h1>
    <form class="login-form" action="includes/login.php" method="Post">
      <input type="username" name="username" placeholder="Username" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type = "submit" id="login-button">Enter</button>
      <a href="CreateNew.php"><button type = "button" id="create-account-button">Create a New Account</button></a>
    </form>
  </div>

</body>
</html>
