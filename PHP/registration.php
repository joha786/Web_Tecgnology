<?php
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registration</title>
    </head>
    <body>
        <h2>Registration Form</h2>
        <form action="showData.php" method = "post">
            First Name: <input type="text" name="fname"><br><br>
            Last Name: <input type="text" name="lname"><br><br>
            Date Of Birth: <input type="date" name="dob"><br><br>
            Gender:
            <input type="radio" name="gender" value="male"> Male
            <input type="radio" name="gender" value="Female">Female
            <br><br>
            Phone: <input type="tel" name="phone"><br><br>
            Email: <input type="email" name="email"><br><br>
            Password: <input type="password" name="password"><br><br>
            Confirm Password: <input type="password" name="confirm"><br><br>
            <input type="submit" value="Submit">
        </form>
    </body>

