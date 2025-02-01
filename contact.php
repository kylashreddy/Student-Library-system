<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "registration_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $messageContent = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $messageContent);

    if ($stmt->execute()) {
        $message = "Your request is sent";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="home.css">
    <title>Contact Us</title>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap");
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: url("https://s3-us-west-2.amazonaws.com/s.cdpn.io/38816/image-from-rawpixel-id-2042508-jpeg.jpg");
            height: 100vh;
            width: 100vw;
            position: relative;
            background-size: cover;
            background-repeat: no-repeat;
            display: grid;
            justify-items: center;
            align-items: center;
            font-family: "Lato", sans-serif;
        }

        .contact-form-container {
            background: #F4F3F3;
            width: 800px;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            grid-template-rows: 0.5fr 0.5fr 2fr;
            grid-template-areas: "contact-us header header header" "contact-us address phone email" "contact-us contact-form contact-form contact-form";
        }

        .contact-us {
            grid-area: contact-us;
            position: relative;
            width: 250px;
            background: #C3E0EC;
            overflow: hidden;
        }

        .contact-us:before {
            position: absolute;
            content: "";
            bottom: -50px;
            left: -100px;
            height: 250px;
            width: 400px;
            background: #F8B7D8;
            transform: rotate(25deg);
        }

        .contact-us:after {
            position: absolute;
            content: "";
            bottom: -80px;
            right: -100px;
            height: 270px;
            width: 400px;
            background: #9ED8EB;
            transform: rotate(-25deg);
        }

        .contact-header {
            color: white;
            position: absolute;
            transform: rotate(-90deg);
            top: 120px;
            left: -40px;
        }

        .contact-header h1 {
            font-size: 1.5rem;
        }

        .header {
            grid-area: header;
            text-align: center;
            padding: 20px 0;
            color: #444;
        }

        .header h1 {
            font-weight: normal;
        }

        .header h2 {
            margin-top: 10px;
            font-weight: 300;
        }

        .address, .email, .phone {
            text-align: center;
            padding: 20px 0;
            color: #444;
        }

        .address h3, .email h3, .phone h3 {
            font-size: 1rem;
            font-weight: 300;
        }

        .address i, .email i, .phone i {
            color: #F8B7D8;
            font-size: 1.7rem;
            margin-bottom: 20px;
        }

        .contact-form {
            grid-area: contact-form;
            padding-bottom: 40px;
        }

        form {
            position: relative;
            width: 440px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            background: white;
        }

        form input, form textarea {
            background: white;
            display: block;
            margin: 20px auto;
            width: 100%;
            border: 0;
        }

        form input {
            height: 40px;
            line-height: 40px;
            outline: 0;
            border-bottom: 1px solid rgba(68, 68, 68, 0.3);
            font-size: 1rem;
            color: rgba(68, 68, 68, 0.8);
        }

        form textarea {
            border-bottom: 1px solid rgba(68, 68, 68, 0.3);
            resize: none;
            outline: none;
            font-size: 1rem;
            font-family: lato;
            color: rgba(68, 68, 68, 0.8);
        }

        form button {
            position: absolute;
            display: block;
            height: 40px;
            width: 250px;
            left: 95px;
            border: 0;
            border-radius: 20px;
            bottom: -20px;
            background: #9ED8EB;
            color: white;
            font-size: 1.1rem;
            font-weight: 300;
            outline: none;
        }

        .social-bar {
            position: absolute;
            bottom: 20px;
            left: 75px;
            z-index: 1;
            width: 100px;
        }

        .social-bar ul {
            list-style-type: none;
        }

        .social-bar ul li {
            display: inline-block;
            color: white;
            width: 25px;
            height: 25px;
            line-height: 25px;
            text-align: center;
            margin-right: -4px;
            font-size: 1.2rem;
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
        body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    padding-top: 70px;
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
            <a href="logout.html"><i class="fas fa-sign-out-alt" title="Logout"></i></a> 
        </div>
    </header>
    <div class="contact-form-container">
        <div class="contact-us">
            <div class="contact-header">
                <h1>&#9135;&#9135;&#9135;&#9135;&nbsp;&nbsp;CONTACT US</h1>
            </div>
            <div class="social-bar">
                <ul>
                    <li><i class="fab fa-facebook-f"></i></li>
                    <li><i class="fab fa-twitter"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                    <li><i class="fab fa-dribbble"></i></li>
                </ul>
            </div>
        </div>
        <div class="header">
            <h1>Let's Get Started</h1>
            <h2>Contact us for more information!</h2>
        </div>
        <div class="address">
            <i class="fas fa-map-marker-alt"></i>
            <h3>JAIN Global Campus</h3>
            <h3>Bengaluru, Karnataka, India - 562112</h3>
        </div>
        <div class="phone">
            <i class="fas fa-phone-alt"></i>
            <h3>080 - 27577198</h3>
        </div>
        <div class="email">
            <i class="fas fa-envelope"></i>
            <h3>set.jainuniversity.ac.in</h3>
        </div>
        <div class="contact-form">
            <form method="POST" action="">
                <input placeholder="Name" type="text" name="name" required />
                <input placeholder="Email" type="email" name="email" required />
                <textarea placeholder="Message..." rows="4" name="message" required></textarea>
                <button type="submit">SEND</button>
            </form>
            <?php if ($message): ?>
        <script>
            showAlert("<?php echo $message; ?>");
        </script>
    <?php endif; ?>
        </div>
    </div>
</body>
</html>