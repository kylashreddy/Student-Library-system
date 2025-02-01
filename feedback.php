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
    $usn = $_POST['usn'];
    $email = $_POST['email'];
    $rating = $_POST['rating'];
    $feedback_text = $_POST['feedback_text'];
    $stmt = $conn->prepare("INSERT INTO feedback (usn, email, rating, feedback_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $usn, $email, $rating, $feedback_text);
    if ($stmt->execute()) {
        echo "<script>alert('Feedback is given'); window.location.href='feedback.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='feedback.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>