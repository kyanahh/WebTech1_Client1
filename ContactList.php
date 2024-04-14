<?php
    include('connection.php'); 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Contact List</title>
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
            background-color: #e0dbdb;
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

        .table-container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 30px;
        }

        table {
            border-collapse: collapse; /* Merge borders between cells */
            width: 90%; /* Set the table width to 100% of its container */
        }
        
        thead{
            background-color: #f5f5f5; /* Set a background color for the header */
        }

        th {
            margin: 30px;
            padding: 10px; /* Add padding to the header cells */
            text-align: left; /* Align header text to the left */
            background-color: black;
            color: white;
        }

        td{
            padding: 10px; /* Add padding to the cells */
        }

        tr:nth-child(even) {
            background-color: #f9f9f9; /* Alternate row background color */
        }

        table, th, td {
            border: 1px solid #dddddd; /* Add borders to the table, header cells, and data cells */
        }

        tr:hover {
            background-color: #f2f2f2; /* Set a background color when hovering over a row */
        }

        .button {
            background-color: green;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            margin-left: 1740px;
            margin-top: 10px;
        }

        .buttonn {
            background-color: grey;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            margin-left: -1860px;
        }

        .buttonnn {
            background-color: red;
            border: none;
            color: white;
            padding: 16px 32px;
            text-align: center;
            font-size: 16px;
            margin: 4px 2px;
            opacity: 0.6;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            margin-left: 70px;
        }

        .button:hover {
            opacity: 1
        }

        .buttonn:hover {
            opacity: 1
        }

        .buttonnn:hover {
            opacity: 1
        }

        body {
            background-repeat: no-repeat;
        }
        
        img {
            height: 120px;
            width: 150px;
        }

        body {
            background-size: 100%;
            background-attachment: fixed;
            background-repeat: no-repeat;
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

    <button class="btn-dark"><a class="a1" href="insert.php">Add Contact</a></button>
     
    <?php
    $query = "SELECT * FROM tbl_contacts";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        echo '<div class="table-container">';
        echo '<table>';
        echo '<tr>';
        echo '<th>ID</th>';
        echo '<th>First Name</th>';
        echo '<th>Last Name</th>';
        echo '<th>Contact Number</th>';
        echo '<th>Address</th>';
        echo '<th>Gender</th>';
        echo '<th>Course</th>';
        echo '<th>Email</th>';
        echo '<th>Image</th>';
        echo '<th colspan="2">Action</th>';
        echo '</tr>';
    
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['studid'] . '</td>';
            echo '<td>' . $row['fname'] . '</td>';
            echo '<td>' . $row['lname'] . '</td>';
            echo '<td>' . $row['cno'] . '</td>';
            echo '<td>' . $row['address'] . '</td>';
            echo '<td>' . $row['gender'] . '</td>';
            echo '<td>' . $row['course'] . '</td>';
            echo '<td>' . $row['email'] . '</td>';
            echo '<td><img src="' . $row['img'] . '" alt="' . $row['fname'] . '"></td>';
            echo "<td><a href='update.php?studid=" . $row['studid'] . "' class='btn-update'>Update</a></td>";
            echo '<td>
                     <form method="POST" action="delete.php">
                        <input type="hidden" name="studid" value="' . $row['studid'] . '">
                        <button type="submit" class="btn-delete" onclick="return confirm(\'Are you sure you want to delete this record?\')">Delete</button>
                    </form>
                 </td>';
            echo '</tr>';
        }
    
        echo '</table>';
        echo '</div>';
    }
    ?>
    

    <script>
		function previewImage(event){
			var reader = new FileReader();
			reader.onload = function(){
				var output = document.getElementById('preview');
				output.src = reader.result;
			}
			reader.readAsDataURL(event.target.files[0]);
		}
	    </script>
</body>
</html>