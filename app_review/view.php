<?php include 'db.php';
$id = $_GET['id'];
$app = $conn->query("SELECT a.*, c.name as category FROM applications a JOIN categories c ON a.category_id = c.id WHERE a.id=$id")->fetch_assoc();
$comments = $conn->query("SELECT * FROM comments WHERE application_id=$id");
?>
<!DOCTYPE html>
<html>
<head>
  <title>View Application</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <a href="index.php" class="btn btn-secondary mb-3">Back</a>
  <h2><?= $app['name'] ?></h2>
  <img src="uploads/<?= $app['image'] ?>" width="150"><br><br>
  <strong>Category:</strong> <?= $app['category'] ?><br>
  <strong>Status:</strong> <?= $app['status'] ?><br>
  <strong>Created:</strong> <?= date("d M Y h:i A", strtotime($app['created_at'])) ?><br>
  <strong>Updated:</strong> <?= date("d M Y h:i A", strtotime($app['updated_at'])) ?><br>

  <hr>
  <h4>Comments</h4>
  <ul>
    <?php while($com = $comments->fetch_assoc()): ?>
      <li><?= $com['comment'] ?> (<?= date("d M Y", strtotime($com['created_at'])) ?>)</li>
    <?php endwhile; ?>
  </ul>

  <form method="POST" class="mt-3">
    <label>Add Comment</label>
    <textarea name="comment" class="form-control" required></textarea><br>
    <button name="save" class="btn btn-primary">Add Comment</button>
  </form>

<?php
if (isset($_POST['save'])) {
  $c = $_POST['comment'];
  $conn->query("INSERT INTO comments (application_id, comment) VALUES ($id, '$c')");
  echo "<script>location.reload()</script>";
}
?>
</body>
</html>
