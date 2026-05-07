<?php
session_start();
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$dob = $_REQUEST['dob'];
$gender = $_REQUEST['gender'];
$phone = $_REQUEST['phone'];
$email = $_REQUEST['email'];
$password = $_REQUEST['password'];
$confirm = $_REQUEST['confirm'];

if(empty($fname)||empty($lname)||empty($dob)||empty($gender)||empty($phone)||empty($email)||empty($password)||empty($confirm)){
    header("Location: registration.php");
    exit();
}
    echo "<h2> User Data </h2>";
    echo "First Name: ".$fname."<br>";
    echo "Last Name: ".$lname."<br>";
    echo "Date of Birth: ".$dob."<br>";
    echo "Gender: ".$gender."<br>";
    echo "Phone: ".$phone."<br>";
    echo "Email: ".$email."<br>";

    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;

    echo "<form action='login.php' method='post'>";
    echo "<input type='submit' value='login'>";
    echo "</form>";
?>