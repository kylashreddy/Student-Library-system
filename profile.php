<?php
session_start(); 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.html"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="home.css">
    <title>User Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            padding-top: 100px;
        }

        header {
            background: white;
            color: black; 
            padding: 15px 20px; 
            display: flex; 
            justify-content: space-between; 
            align-items: center; 
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2); 
            position: fixed; 
            top: 0;
            width: 100%; 
            z-index: 1000; 
        }

        .logo {
            display: flex;
            align-items: center; 
        }

        .logo img {
            height: 50px; 
            margin-right: 20px; 
        }

        nav {
            display: flex; 
        }

        nav a {
            color: black; 
            text-decoration: none;
            padding: 10px 15px; 
            margin: 0 10px; 
            transition: background 0.3s; 
        }

        nav a:hover {
            background: rgba(255, 255, 255, 0.2); 
            border-radius: 5px; 
        }

        .icons {
            display: flex; 
            align-items: center; 
        }

        .icons i {
            color: blue; 
            margin-left: 20px; 
            cursor: pointer;
            transition: color 0.3s; 
        }

        .icons i:hover {
            color: #FFD700; 
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="welcome.html"><img src="jain.png" alt="Logo"> </a>
        </div>
        <nav>
            <a href="home.html">About</a>
            <a href="pro.html">Books</a>
            <a href="faculty.html">Faculty</a>
            <a href="contact.html">Contact Us</a>
            <a href="contactus.html">Feedback</a>
            <a href="profile.php">Profile</a>
        </nav>
        <div class="icons">
            <a href="loginproj.html"><i class="fas fa-user" title="Login"></i></a>
            <a href="logout.php"><i class="fas fa-sign-out-alt" title="Logout"></i></a> 
        </div>
    </header>

    <main>
        <h1>Welcome to your profile!</h1>
        <p>Email: <?php echo htmlspecialchars($_SESSION['user_email']); ?></p>
        <p>Name: <?php echo htmlspecialchars($_SESSION['user_name']); ?></p>
        <a href='logout.html'>Logout</a>
    </main>
</body>
</html>