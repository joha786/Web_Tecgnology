<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <h2>Login Form</h2>
        <form action="login.php" method="post">
            Email: <input type="email" name="email"><br><br>
            Password: <input type="password" name="password"><br><br>
            <input type="submit" value="Login">
        </form>
    </body>
</html>

<?php
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(empty($email)||empty($password)){
        header("Location: login.php");
        exit();
    }

    if($email == $_SESSION['email'] && $password == $_SESSION['password']){
        echo "<h2>Login Successful</h2>";
        echo "Welcome, ".$email."!";
    }else{
        echo "<h2>Login Failed</h2>";
        echo "Invalid email or password.";
    }
}
?>