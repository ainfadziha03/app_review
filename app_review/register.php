<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Register</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Full Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button name="register" class="btn btn-primary">Register</button>
    <a href="login.php" class="btn btn-link">Login here</a>
  </form>

<?php
if (isset($_POST['register'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = hash('sha256', $_POST['password']);

  $check = $conn->query("SELECT * FROM users WHERE email='$email'");
  if ($check->num_rows > 0) {
    echo "<div class='alert alert-warning mt-3'>Email already registered!</div>";
  } else {
    $conn->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')");
    echo "<div class='alert alert-success mt-3'>Registration successful. <a href='login.php'>Login now</a></div>";
  }
}
?>
</body>
</html>
