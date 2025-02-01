<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "books_register";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_type = $_POST['userType'];
    $first_name = $_POST['First Name'];
    $last_name = $_POST['Last Name'];
    $dob = $_POST['DOB'];
    $usn = $_POST['USN'];
    $phone_no = $_POST['Phone No'];
    $email = $_POST['Email'];
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT); 
    $department = $_POST['Department']; 
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("INSERT INTO users (user_type, first_name, last_name, dob, usn, phone_no, email, password, department, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $userType, $firstName, $lastName, $dob, $usn, $phoneNo, $email, $password, $department, $gender);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>