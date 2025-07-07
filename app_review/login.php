<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="style.css"> <!-- Ini wajib -->
</head>

</head>
<body class="container mt-5">
  <h2>Login to Mobile Apps Review</h2>
  <form method="POST">
    <div class="mb-3">
      <label>Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>Password</label>
      <input type="password" name="password" class="form-control" required>
    </div>
    <button name="login" class="btn btn-primary">Login</button>
    <a href="register.php" class="btn btn-link">Register here</a>
  </form>

<?php
if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = hash('sha256', $_POST['password']);

  $query = $conn->query("SELECT * FROM users WHERE email='$email' AND password='$password'");
  if ($query->num_rows == 1) {
    $user = $query->fetch_assoc();
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_name'] = $user['name'];
    header("Location: index.php");
  } else {
    echo "<div class='alert alert-danger mt-3'>Invalid login credentials.</div>";
  }
}
?>
</body>
</html>
