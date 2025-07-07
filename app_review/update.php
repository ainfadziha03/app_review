<?php include 'db.php';
$id = $_GET['id'];
$data = $conn->query("SELECT * FROM applications WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Edit Review</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Edit Application Review</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Name</label>
      <input type="text" name="name" value="<?= $data['name'] ?>" class="form-control">
    </div>
    <div class="mb-3">
      <label>Category</label>
      <select name="category_id" class="form-control">
        <?php
        $cats = $conn->query("SELECT * FROM categories");
        while ($cat = $cats->fetch_assoc()) {
          $sel = ($cat['id'] == $data['category_id']) ? 'selected' : '';
          echo "<option value='{$cat['id']}' $sel>{$cat['name']}</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="active" <?= $data['status'] == 'active' ? 'selected' : '' ?>>Active</option>
        <option value="inactive" <?= $data['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
      </select>
    </div>
    <div class="mb-3">
      <label>Image (Leave blank to keep current)</label>
      <input type="file" name="image" class="form-control">
    </div>
    <button name="update" class="btn btn-warning">Update</button>
    <a href="index.php" class="btn btn-secondary">Cancel</a>
  </form>

<?php
if (isset($_POST['update'])) {
  $name = $_POST['name'];
  $cat = $_POST['category_id'];
  $status = $_POST['status'];

  if ($_FILES['image']['name']) {
    $image = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];
    move_uploaded_file($tmp, "uploads/$image");
    $conn->query("UPDATE applications SET name='$name', category_id='$cat', image='$image', status='$status' WHERE id=$id");
  } else {
    $conn->query("UPDATE applications SET name='$name', category_id='$cat', status='$status' WHERE id=$id");
  }
  echo "<div class='alert alert-success mt-3'>Updated successfully!</div>";
}
?>
</body>
</html>
