<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "registration_db"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = htmlspecialchars($_POST['userType']);
    $firstName = htmlspecialchars($_POST['FirstName']);
    $lastName = htmlspecialchars($_POST['LastName']);
    $dob = htmlspecialchars($_POST['DOB']);
    $usn = htmlspecialchars($_POST['USN']);
    $phoneNo = htmlspecialchars($_POST['PhoneNo']);
    $email = htmlspecialchars($_POST['Email']);
    $password = password_hash(htmlspecialchars($_POST['Password']), PASSWORD_DEFAULT); 
    $department = htmlspecialchars($_POST['Department']);
    $gender = htmlspecialchars($_POST['gender']);

    $stmt = $conn->prepare("INSERT INTO users (userType, firstName, lastName, dob, usn, phoneNo, email, Password, department, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $userType, $firstName, $lastName, $dob, $usn, $phoneNo, $email, $password, $department, $gender);

    if ($stmt->execute()) {
        echo "<script>alert('Registration Successful!'); window.location.href='loginproj.html';</script>";
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>