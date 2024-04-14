<?php
include("connection.php");

$studid = $_GET["studid"];

$fname = $lname = $image = $cno = $address = $email = $gender = $course = "";
$image = "default.jpg";

$sql = "SELECT * FROM tbl_contacts WHERE studid = '$studid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $fname = $row["fname"];
    $lname = $row["lname"];
    $image = $row["image"];
    $cno = $row["cno"];
    $address = $row["address"];
    $gender = $row["gender"];
    $course = $row["course"];
} else {
    echo "No record found";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it
    $fname = mysqli_real_escape_string($conn, ucwords($_POST["fname"]));
    $lname = mysqli_real_escape_string($conn, ucwords($_POST["lname"]));
    $cno = mysqli_real_escape_string($conn, $_POST["cno"]);
    $address = mysqli_real_escape_string($conn, ucwords($_POST["address"]));
    $gender = mysqli_real_escape_string($conn, $_POST["gender"]);
    $course = mysqli_real_escape_string($conn, $_POST["course"]);

    // Check if an image was uploaded
    if (isset($_FILES["img"]) && $_FILES["img"]["name"]) {
        // Get the uploaded file name and extension
        $filename = basename($_FILES["img"]["name"]);
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");

        // Check if the uploaded file is a valid image file
        if (!in_array($extension, $allowed_extensions)) {
            echo "Invalid image file. Allowed extensions: " . implode(", ", $allowed_extensions);
            exit();
        }

        // Generate a unique filename for the uploaded image
        $new_filename = $studid . "." . $extension;

        // Move the uploaded image to the uploads directory
        if (!move_uploaded_file($_FILES["img"]["tmp_name"], "uploads/" . $new_filename)) {
            echo "Error uploading image file";
            exit();
        }

        // Delete the previous image file
        if ($image != "default.jpg" && file_exists("uploads/" . $image)) {
            unlink("uploads/" . $image);
        }

        // Set the image filename to the new filename
        $image = "uploads/" . $new_filename;
    }

    // Prepare SQL statement
    $sql = "UPDATE tbl_contacts SET fname = '$fname', lname = '$lname', img = '$image', cno = '$cno', address = '$address', gender = '$gender', course = '$course' WHERE studid = '$studid'";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        // Redirect to view page with success message
        header("Location: ContactList.php?studid=$studid&message=success");
        exit();
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="style.css">
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
        
        .card {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f7f7f7;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            margin-bottom: 15px;
        }

        .form-control label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-control input,
        .form-control textarea,
        .form-control select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
            resize: vertical;
        }

        .form-control input[type="file"] {
            padding: 5px 0;
        }

        .form-control button {
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
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
    <h1>Edit Student</h1>
    <form method="POST" enctype="multipart/form-data">
      <div class="form-control">
        <label for="fname">First Name</label>
        <input type="text" name="fname" id="fname" value="<?php echo $fname; ?>" required>
      </div>
      <div class="form-control">
        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" value="<?php echo $lname; ?>" required>
      </div>
      <div class="form-control">
        <label for="img">Image:</label>
        <input type="file" name="img" id="img" required>
      </div>
      <div class="form-control">
        <label for="cno">Contact Number:</label>
        <input type="text" name="cno" id="cno" value="<?php echo $cno; ?>" required>
      </div>
      <div class="form-control">
        <label for="address">Address</label>
        <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
      </div>
      <div class="form-control">
        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" value="<?php echo $gender; ?>" required>
      </div>
      <div class="form-control">
        <label for="course">Course:</label>
        <input type="text" name="course" id="course" value="<?php echo $course; ?>" required>
      </div>
      <div class="form-control">
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="<?php echo $email; ?>" required>
      </div>
      <div class="form-control">
        <label for="image">Profile Picture:</label><br>
        <img id="preview" src="<?php echo $image; ?>" width="100" height="100"><br>
        <input type="file" name="image" onchange="previewImage(event)">
      </div>
      <div class="form-control">
        <input type="submit" class="btn-dark1" value="Update">
        <input type="button" class="btn-dark2" value="Cancel" onclick="location.href='profile.php?studid=<?php echo $studid; ?>'">
      </div>
    </form>
  </div>
</main>

<script>
  function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
      var output = document.getElementById('preview');
      output.src = reader.result;
    }
    reader.readAsDataURL(event.target.files[0]);
  }
</script>

</body>
</html>
