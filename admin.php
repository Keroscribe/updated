<?php
require './middleware/adminMiddleware.php';
include "config.php";
$result = $db->query("SELECT * FROM posts ORDER BY date DESC");
checkAdminAccess();

if(!isset($_SESSION["username"]))
{
  $_SESSION["error"] = "You do not have admin access.";
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
    /* General styles */
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      color: #fff;
      background-color: #222;
      display: flex;
      overflow-x: hidden;
    }

    /* Sidebar */
    .sidebar {
      width: 160px;
      background-color: #111;
      height: 100vh;
      display: flex;
      flex-direction: column;
      padding: 20px;
      position: fixed;
      top: 0;
      left: 0;
      transition: transform 0.3s ease-in-out;
    }

    .sidebar.hidden {
      transform: translateX(-100%);
    }

    .sidebar h1 {
      font-size: 24px;
      color: #ff8c00;
      margin-bottom: 30px;
    }

    .sidebar a {
      color: #fff;
      text-decoration: none;
      margin: 10px 0;
      display: block;
      padding: 10px;
      border-radius: 5px;
    }

    .sidebar a:hover {
      background-color: #333;
    }

    /* Main content */
    .main-content {
      margin-left: 250px;
      padding: 20px;
      width: 100%;
      transition: margin-left 0.3s ease-in-out;
    }

    .main-content.shifted {
      margin-left: 0;
    }

    .header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .header h2 {
      margin: 0;
    }

    .header .profile {
      background-color: #ff8c00;
      width: 35px;
      height: 35px;
      border-radius: 50%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
      color: #111;
    }

    .menu-toggle {
      background-color: #ff8c00;
      color: #111;
      border: none;
      padding: 10px;
      cursor: pointer;
      border-radius: 5px;
      font-size: 16px;
      display: none;
    }

    .menu-toggle.visible {
      display: block;
    }

    /* Form styling */
    .form-container {
      background-color: #333;
      padding: 20px;
      border-radius: 10px;
    }

    .form-container label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }

    .form-container input,
    .form-container textarea,
    .form-container select,
    .form-container button {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #555;
      border-radius: 5px;
      background-color: #444;
      color: #fff;
    }

    .form-container textarea {
      height: 100px;
      resize: none;
    }

    .form-container button {
      width: auto;
      padding: 10px 20px;
      cursor: pointer;
    }

    .form-container .btn-save {
      background-color: #4CAF50;
      border: none;
    }

    .form-container .btn-cancel {
      background-color: #f44336;
      border: none;
    }

    .form-container button:hover {
      opacity: 0.9;
    }

    @media (max-width: 768px) {
      .sidebar {
        position: fixed;
        transform: translateX(-100%);
      }

      .main-content {
        margin-left: 0;
      }

      .menu-toggle.visible {
        display: block;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">
    <h1>Coffean.</h1>
    <a href="#">Dashboard</a>
    <a href="#">Post</a>
    <a href="#">Categories</a>
    <a href="#">Blog</a>
    <a href="logout.php">Logout</a>
  </div>

  <!-- Main Content -->
  <div class="main-content" id="main-content">
    <div class="header">
   
      <h2>Create Post</h2>
      <div class="profile">A</div>
    </div>
    <div class="form-container">
      <form action="save_post.php" method="post" enctype="multipart/form-data">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" placeholder="Enter post title">

        <label for="category">Category</label>
        <input type="text" id="category" name="category" placeholder="Enter category">

        <label for="tags">Tags</label>
        <input type="text" id="tags" name="tags" placeholder="Enter tags (comma separated)">

        <label for="content">Content</label>
        <textarea id="content" name="content" placeholder="Write your post content here..."></textarea>

        <label for="photo">Photo</label>
        <input type="file" id="photo" name="photo">

        <label for="date">Date</label>
        <input type="date" id="date" name="date" value="2024-12-03">

        <label for="status">Status</label>
        <select id="status" name="status">
          <option value="draft">Draft</option>
          <option value="published">Published</option>
        </select>

        <button type="button" class="btn-cancel">Cancel</button>
        <button type="submit" class="btn-save">Save</button>
      </form>
    </div>
  </div>

  <script>
     const sidebar = document.getElementById('sidebar');
    const menuToggle = document.getElementById('menu-toggle');

    menuToggle.addEventListener('click', () => {
      // Toggle visibility of the sidebar
      sidebar.classList.toggle('hidden');
    });

  </script>
</body>
</html>
