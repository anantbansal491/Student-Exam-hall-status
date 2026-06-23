<?php
session_start();
include "config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM teachers WHERE username='$username'");

    if ($result->num_rows == 1) {
        $_SESSION['teacher'] = $username;
        header("Location: dashboard.php");
        exit;
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>

  <title>Teacher Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
      background-image: url('https://pbs.twimg.com/media/F1E5B1AXoAAWI0V.jpg');
      background-size: cover;
      background-position: center;
      color: white;
    }
    .container {
      max-width: 400px;
      margin: 250px auto;
      padding: 20px;
      background: rgba(0, 0, 0, 0.7);
      border-radius: 10px;
      box-shadow: 0px 0px 10px rgba(255, 255, 255, 0.5);
      transform: translateY(-20px);
            animation: fadeIn 0.9s forwards ease-in-out;
    }
    @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }}
    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }
    button {
      background: #90d5ff;
      color: black;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      border-radius: 5px;
      transition: 0.3s;
      
    }
    button:hover {
      background: lightgreen;
      transform: scale(1.05);
    }
    .logo {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 2in;
      height: 2in;
    }
  </style>
</head>
<body>


<img class="logo" src="https://colab.ws/storage/images/resized/oJTFaqujqqDFZEErI833ng4oLPZVC685xSHtTKs1_medium.webp" alt="Logo">

<div class="container">
  <h2>Teacher Login</h2>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
  </form>
</div>

</body>
</html>
