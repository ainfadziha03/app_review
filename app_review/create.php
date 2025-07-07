<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
  <title>Add Review</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h2>Add New Application Review</h2>
  <form method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label>Application Name</label>
      <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
      <label>Category</label>
      <select name="category_id" class="form-control">
        <?php
          $cats = $conn->query("SELECT * FROM categories");
          while ($cat = $cats->fetch_assoc()) {
            echo "<option value='{$cat['id']}'>{$cat['name']}</option>";
          }
        ?>
      </select>
    </div>

    <div class="mb-3">
      <label>Status</label>
      <select name="status" class="form-control">
        <option value="active">Active</option>
        <option value="inactive">Inactive</option>
      </select>
    </div>

    <div class="mb-3">
      <label>Image</label>
      <input type="file" name="image" class="form-control" required>
    </div>

    <button name="submit" class="btn btn-primary">Save</button>
    <a href="index.php" class="btn btn-secondary">Back</a>
  </form>

<?php
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $cat = $_POST['category_id'];
  $status = $_POST['status'];

  $image = $_FILES['image']['name'];
  $tmp = $_FILES['image']['tmp_name'];

  // ✅ Pastikan folder 'uploads/' wujud
  if (!is_dir('uploads')) {
    mkdir('uploads', 0777, true);
  }

  // ✅ Pindahkan gambar ke folder 'uploads'
  if (move_uploaded_file($tmp, "uploads/$image")) {
    // ✅ Masukkan ke database
    $conn->query("INSERT INTO applications (name, category_id, image, status) 
                  VALUES ('$name', '$cat', '$image', '$status')");
    echo "<div class='alert alert-success mt-3'>Application Review Added!</div>";
  } else {
    echo "<div class='alert alert-danger mt-3'>Image upload failed. Please check folder permission.</div>";
  }
}
?>
</body>
</html>
