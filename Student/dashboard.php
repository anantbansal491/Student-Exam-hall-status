<?php
session_start();
include "config.php";

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit;
}

$teacher = $_SESSION['teacher'];
$result = $conn->query("SELECT * FROM exam_rooms WHERE teacher_id=(SELECT id FROM teachers WHERE username='$teacher')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Teacher Dashboard</title>
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
      max-width: 800px;
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
      }
    }
    .room-list button {
      background: linear-gradient(to right, #74ebd5, #acb6e5);
      color: black;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      font-weight: bold;
      border-radius: 5px;
      transition: 0.3s;
      display: block;
      width: 100%;
      margin: 10px 0;
    }
    .room-list button:hover {
      background: #90EE90;
      transform: scale(1.05);
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
      background: red;
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

<!-- Logo at the top left corner -->
<img class="logo" src="https://colab.ws/storage/images/resized/oJTFaqujqqDFZEErI833ng4oLPZVC685xSHtTKs1_medium.webp" alt="Logo">

<div class="container">
  <h2>Welcome, <?php echo $teacher; ?></h2>
  <h3>Your Assigned Rooms</h3>
  <div class="room-list">
    <?php while ($row = $result->fetch_assoc()) { ?>
      <form action="students.php" method="GET">
        <input type="hidden" name="room_id" value="<?php echo $row['id']; ?>">
        <button type="submit">
          Room: <?php echo $row['room_no']; ?> - Date: <?php echo $row['exam_date']; ?> - Shift: <?php echo $row['shift']; ?>
        </button>
      </form>
    <?php } ?>
  </div>
  <button onclick="window.location.href='logout.php'">Logout</button>
</div>

</body>
</html>
