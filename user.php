<?php
session_start();
// Initialize error message
$error = "";

include "config.php";
// Check if there is an error message in the session
if (isset($_SESSION["error"])) {
    $error = $_SESSION["error"];
    unset($_SESSION["error"]); // Clear the error after displaying
}

if(!isset($_SESSION["username"]))
{
  $_SESSION["error"] = "You must be logged in to access this page.";
	header("location:userlogin.php");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Coffean Admin</title>
  <style>
body {
  margin: 0;
  padding: 0;
  font-family: Arial, sans-serif;
  background-color: #1e1e1e;
  color: #ffffff;
}

.container {
  max-width: 600px;
  margin: 50px auto;
  background-color: #2c2c2c;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
}

.header {
  display: flex;
  justify-content: flex-end;
  align-items: center;
  margin-bottom: 20px;
}

.admin {
  margin-right: 10px;
}

.avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
}

.form label {
  display: block;
  margin-bottom: 5px;
  font-size: 14px;
}

.form input,
.form textarea {
  width: 100%;
  padding: 10px;
  margin-bottom: 15px;
  border: none;
  border-radius: 5px;
  background-color: #3c3c3c;
  color: #ffffff;
}

.form textarea {
  resize: none;
  height: 100px;
}

.buttons {
  display: flex;
  justify-content: space-between;
}

.cancel {
  background-color: #e74c3c;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.save {
  background-color: #2ecc71;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
}

.cancel:hover {
  background-color: #c0392b;
}

.save:hover {
  background-color: #27ae60;
}



 
  </style>
<!DOCTYPE html>
<html>
<head>
    <title>User Dashboard</title>
</head>
<body>
    <h1>Dashboard</h1>

    <?php
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'imnotadev'); // Replace 'your_database' with the actual database name

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to fetch posts
    $sql = "SELECT * FROM posts"; // Replace 'posts' with your actual table name
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Content</th>
                <th>Photo</th>
                <th>Date</th>
                <th>Author</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['tags']) ?></td>
                <td><?= htmlspecialchars($row['content']) ?></td>
                <td>
                    <?php if ($row['photo']): ?>
                        <img src="<?= htmlspecialchars($row['photo']) ?>" alt="Photo" width="100">
                    <?php else: ?>
                        No Photo
                    <?php endif; ?>
                </td>
                <td><?= htmlspecialchars($row['date']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>  
                <td><?= htmlspecialchars($row['status']) ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No posts found.</p>
    <?php endif;

    $conn->close();
    ?>
</body>
</html>

  
