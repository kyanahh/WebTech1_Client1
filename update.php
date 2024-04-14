<?php
include('connection.php');

$studid = $_GET['studid'];

$fname = $lname = $img = $cno = $address = $email = $gender = $course = $email = "";
$img = "default.jpg";
$error_message = "";

$sql = "SELECT * FROM tbl_contacts WHERE studid = '$studid'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    
    $fname = $row["fname"];
    $lname = $row["lname"];
    $img = $row["img"];
    $cno = $row["cno"];
    $address = $row["address"];
    $gender = $row["gender"];
    $course = $row["course"];
    $email = $row["email"];
   
} else {
    echo "No record found";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize it

    if (empty($fname) || empty($lname)) {
        $error_message = "Please fill in the required fields.";
    }
    
    $fname = mysqli_real_escape_string($conn, ucwords($_POST["fname"]));
    $lname = mysqli_real_escape_string($conn, ucwords($_POST["lname"]));
    $cno = mysqli_real_escape_string($conn, $_POST["cno"]);
    $address = mysqli_real_escape_string($conn, ucwords($_POST["address"]));
    $gender = mysqli_real_escape_string($conn, ucwords($_POST["gender"]));
    $course = mysqli_real_escape_string($conn, $_POST["course"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);

    // Check if an image was uploaded
    if ($_FILES["img"]["name"]) {
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
        if ($img != "default.jpg" && file_exists("uploads/" . $img)) {
            unlink("uploads/" . $img);
        }

        // Set the image filename to the new filename
        $img = "uploads/" . $new_filename;
    }

    // Prepare SQL statement
    $sql = "UPDATE tbl_contacts SET fname = '$fname', lname = '$lname', img = '$img', cno = '$cno', address = '$address', gender = '$gender', course = '$course', email = '$email' WHERE studid = '$studid'";

    // Execute SQL statement
    if (mysqli_query($conn, $sql)) {
        // Redirect to view page with success message
        header("Location: ContactList.php?studid=$studid&message=success");
        exit();
    } else {
        $error_message = "Error updating record: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Contact</title>
    <link rel="stylesheet" type="text/css" href="style.css">
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
            margin-bottom: 30px;
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
            <h1>Update Contact</h1>
            <form method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?studid=$studid"; ?>">
                <div class="form-control">
                    <label for="fname">First Name:</label>
                    <input type="text" name="fname" value="<?php echo $fname; ?>" required>
                </div>
                <div class="form-control">
                    <label for="lname">Last Name:</label>
                    <input type="text" name="lname" value="<?php echo $lname; ?>" required>
                </div>
                <div class="form-control">
                    <label for="img">Image:</label>
                    <input type="file" name="img">
                </div>
                <div class="form-control">
                    <label for="cno">Contact Number:</label>
                    <input type="text" name="cno" value="<?php echo $cno; ?>">
                </div>
                <div class="form-control">
                    <label for="address">Address:</label>
                    <input type="text" name="address" value="<?php echo $address; ?>">
                </div>
                <div class="10px">
                    <label for="gender">Gender:</label>
                    <input class="ms-3" type="radio" name="gender" value="Male" <?php echo (strtolower($gender) === "male") ? "checked" : ""; ?>> Male
                    <input class="ms-3" type="radio" name="gender" value="Female" <?php echo (strtolower($gender) === "female") ? "checked" : ""; ?>> Female
                </div>
                <div class="form-control" style="margin-top: 10px;">
                    <label for="email">Email:</label>
                    <input type="email" name="email" value="<?php echo $email; ?>">
                </div>
                <div class="form-control">
                    <label for="course">Course:</label>
                    <input type="text" name="course" id="course" value="<?php echo $course; ?>" required>
                  </div>
                <input class="btn-dark2" type="submit" value="Update" name="update">
            </form>
            <?php
                // Check for success message in URL parameters
                if (isset($_GET['message']) && $_GET['message'] === 'success') {
                    echo '<p class="success-message">Contact updated successfully!</p>';
                } elseif (!empty($error_message)) {
                    echo '<p class="error-message">' . $error_message . '</p>';
                }
            ?>
        </div>
    </main>
</body>
</html>
