<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Style for the navigation bar */
		nav {
			background-color: #333;
			overflow: hidden;
		}
		
		/* Style for the links in the navigation bar */
		nav a {
			float: left;
			display: block;
			color: white;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}
		
		/* Style for the dropdown menu */
		.dropdown {
			float: left;
			overflow: hidden;
		}
		
		/* Style for the dropdown button */
		.dropdown .dropbtn {
			font-size: 16px;
			border: none;
			outline: none;
			color: white;
			padding: 14px 16px;
			background-color: inherit;
			font-family: inherit;
			margin: 0;
		}
		
		/* Style for the links in the dropdown menu */
		.dropdown-content a {
			float: none;
			color: black;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}
		
		/* Style for the dropdown menu when the mouse is over it */
		.dropdown:hover .dropdown-content {
			display: block;
		}
		
		/* Style for the active link in the navigation bar */
		.active {
			background-color: #4CAF50;
			color: white;
		}
    </style>
</head>
<body>
    <nav>
		<a class="active" href="index.php">Home</a>
		<a href="add.php">Add Contact</a>
		<a href="Manage.php">Manage Contact</a>

	</nav>
</body>
</html>