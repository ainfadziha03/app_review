<?php include 'db.php'; include 'session.php'; ?>

<a href="logout.php" class="btn btn-danger">Logout (<?= $_SESSION['user_name'] ?>)</a>

<!DOCTYPE html>
<html>
<head>
  <title>Application Reviews</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-5">
  <h1>Application Reviews</h1>

  <a href="create.php" class="btn btn-success mb-3">Add New Review</a>
  <a href="export_pdf.php" class="btn btn-danger mb-3">Export to PDF</a>

  <form method="GET" class="mb-3">
    <input type="text" name="search" placeholder="Search by app name..." class="form-control" />
  </form>

  <a href="export_pdf.php" class="btn btn-danger mb-3">Export to PDF</a>


  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Image</th>
        <th>App Name</th>
        <th>Status</th>
        <th>Category</th>
        <th>Created</th>
        <th>Updated</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
<?php
$search = $_GET['search'] ?? '';
$sql = "SELECT a.*, c.name AS category FROM applications a JOIN categories c ON a.category_id = c.id 
        WHERE a.name LIKE '%$search%'";
$result = $conn->query($sql);

while($row = $result->fetch_assoc()):
?>
<tr>
  <td><img src="uploads/<?= $row['image'] ?>" width="60"></td>
  <td><?= $row['name'] ?></td>
  <td>
    <?php if ($row['status'] == 'active') echo "<span class='badge bg-success'>Active</span>";
          else echo "<span class='badge bg-secondary'>Inactive</span>"; ?>
  </td>
  <td><?= $row['category'] ?></td>
  <td><?= date("d M Y h:i A", strtotime($row['created_at'])) ?></td>
  <td><?= date("d M Y h:i A", strtotime($row['updated_at'])) ?></td>
  <td>
    <a href="view.php?id=<?= $row['id'] ?>" class="btn btn-info btn-sm">View</a>
    <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</a>
  </td>
</tr>
<?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>




