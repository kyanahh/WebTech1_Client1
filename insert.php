<?php
include('connection.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $cno = $_POST['cno'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    $targetDirectory = 'uploads/';
    $targetFile = $targetDirectory . basename($_FILES['img']['name']);

    if (move_uploaded_file($_FILES['img']['tmp_name'], $targetFile)) {
        // File uploaded successfully
        // Save the file path to the database or perform further processing
        $img = $targetFile;

        // Perform database insertion here
        // Assuming you have a database connection established

        // Example using MySQLi
        $sql = "INSERT INTO tbl_contacts (fname, lname, img, cno, address, gender, course, email)
                VALUES ('$fname', '$lname', '$img', '$cno', '$address', '$gender', '$course', '$email')";

        if ($conn->query($sql) === TRUE) {
            $conn->close();
            header("location: ContactList.php");
            exit; // Terminate the script after redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            $conn->close();
        }
    } else {
        // Error uploading file
        // Handle the error appropriately
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Document</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    main {
      width: 100vw;
      height: 100vh;
      background-repeat: no-repeat;
      background-size: 1960px;
    }

    nav {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 1%;
      background-color: black;
    }

    .navi ul {
      display: flex;
      list-style-type: none;
      color: white;
    }

    .navi li a {
      text-decoration: none;
      color: white;
      margin: 0 14px;
    }

    nav h1 {
      color: white;
    }
</style>
</head>
<body>

<nav>
    <h1>UwU</h1>
    <div class="navi">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="ContactList.php">Contact</a></li>
        </ul>
    </div>
</nav>

<main>
  <div class="card">
    <form method="POST" enctype="multipart/form-data">
      <div class="form-control">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" required>
      </div>
      <div class="form-control">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" required>
      </div>
      <div class="form-control">
        <label for="img">Image:</label>
        <input type="file" name="img" id="img" required>
      </div>
      <div class="form-control">
        <label for="cno">Contact Number:</label>
        <input type="text" name="cno" id="cno" required>
      </div>
      <div class="form-control">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" required>
      </div>
      <div class="form-control">
        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" required>
      </div>
      <div class="form-control">
        <label for="course">Course:</label>
        <input type="text" name="course" id="course" required>
      </div>
      <div class="form-control">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" required>
      </div>
      <button type="submit" class="btn-dark1">Add Contact</button>
    </form>
  </div>
</main>

</body>
</html>