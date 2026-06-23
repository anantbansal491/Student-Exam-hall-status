<?php
session_start();
include "config.php";

if (!isset($_SESSION['teacher'])) {
    header("Location: login.php");
    exit;
}

$room_id = $_GET['room_id'];
$students = $conn->query("SELECT * FROM students WHERE room_id='$room_id'");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $is_present = $_POST['is_present'];
    $ufm = $_POST['ufm'];
    
    $conn->query("UPDATE students SET is_present='$is_present', ufm='$ufm' WHERE id='$student_id'");
    header("Location: students.php?room_id=$room_id");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Student List</title>
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
      max-width: 990px;
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
    table {
      width: 100%;
      border-collapse: collapse;
      background: rgba(255, 255, 255, 0.9);
      color: black;
      border-radius: 10px;
    }
    th, td {
      padding: 10px;
      border: 1px solid black;
      text-align: center;
    }
    th {
      background:linear-gradient(to right, #74ebd5, #acb6e5);
    }
    select, button {
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    button {
      background: #90d5ff;;
      color: black;
      font-weight: bold;
      cursor: pointer;
      transition: 0.3s;
    }
    button:hover {
      background: lightgreen;
      transform: scale(1.05);
    }
    .btn-group {
      margin-top: 15px;
    }
    .logo {
      position: absolute;
      top: 10px;
      left: 10px;
      width: 2in;
      height: 2in;
    }
    .present { background-color: lightgreen; }
    .absent { background-color: lightcoral; }
    .ufm-yes { background-color: lightcoral; }
    .ufm-no { background-color: lightgreen; }
  </style>
</head>
<body>


<img class="logo" src="https://colab.ws/storage/images/resized/oJTFaqujqqDFZEErI833ng4oLPZVC685xSHtTKs1_medium.webp" alt="Logo">

<div class="container">
  <h2>Student List</h2>
  <table>
    <tr>
      <th>Roll No</th>
      <th>Name</th>
      <th>Course</th>
      <th>Subject</th>
      <th>Subject Code</th>
      <th>Year</th>
      <th>Semester</th>
      <th>Exam Shift</th>
      <th>Present</th>
      <th>UFM</th>
      <th>Action</th>
    </tr>
    <?php while ($row = $students->fetch_assoc()) { ?>
    <tr>
      <td><?php echo $row['roll_no']; ?></td>
      <td><?php echo $row['name']; ?></td>
      <td><?php echo $row['course']; ?></td>
      <td><?php echo $row['subject']; ?></td>
      <td><?php echo $row['subject_code']; ?></td>
      <td><?php echo $row['year']; ?></td>
      <td><?php echo $row['semester']; ?></td>
      <td><?php echo $row['exam_shift']; ?></td>
      <td>
        <form method="post">
          <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
          <select name="is_present" class="<?php echo ($row['is_present'] == 'Present') ? 'present' : 'absent'; ?>" onchange="this.form.submit()">
            <option value="Present" <?php echo ($row['is_present'] == 'Present') ? 'selected' : ''; ?>>Present</option>
            <option value="Absent" <?php echo ($row['is_present'] == 'Absent') ? 'selected' : ''; ?>>Absent</option>
          </select>
      </td>
      <td>
          <select name="ufm" class="<?php echo ($row['ufm'] == 'No') ? 'ufm-no' : 'ufm-yes'; ?>" onchange="this.form.submit()">
            <option value="No" <?php echo ($row['ufm'] == 'No') ? 'selected' : ''; ?>>No</option>
            <option value="Yes" <?php echo ($row['ufm'] == 'Yes') ? 'selected' : ''; ?>>Yes</option>
          </select>
      </td>
      <td>
        <button type="submit">Update</button>
        </form>
      </td>
    </tr>
    <?php } ?>
  </table>

  <div class="btn-group">
    <button onclick="window.location.href='dashboard.php'">Back</button>
  </div>
</div>

</body>
</html>
