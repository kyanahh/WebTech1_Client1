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
            background-color: #f2f2f2;
            background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url("bgmain.jpg");
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

        .title h2 {
            font-size: 70px;
            margin-top: 150px;
        }

        .title p {
            font-size: 18px;
        }

        .button {
            background-color: black;
            border: none;
            color: white;
            padding: 16px 32px;
            font-size: 16px;
            margin: 4px 2px;
            transition: 0.3s;
            display: inline-block;
            text-decoration: none;
            cursor: pointer;
            justify-content: space-between;
            margin-top: 40px;
        }
        
        .button a {
            color: white;
            text-decoration: none;
        }

        .button:hover {
            opacity: 0.7
        }

    </style>
</head>

<body>
    <main>
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

        <div class="row">
          <div class="title text-center col-2 text-white">
            <h2>UwU Contact List</h2>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Where you can enter all your information without any hassle.</p>
            <button class="button"><a href="Contactlist.php">Click to see all Contacts</a></button>
          </div>
        </div>
          
    </main>

</body>

</html>