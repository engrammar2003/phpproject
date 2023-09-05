<?php
    
    include 'mysql-db.php';

    if(isset($_POST['submit'])){

        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
        $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

        $select = mysqli_query($conn,"SELECT * FROM `register_form` WHERE email = '$email' AND password = '$pass' ");

        if(mysqli_num_rows($select) > 0 ){
            $message[]= 'user already exist!';
        }else{
            mysqli_query($conn,"INSERT INTO `register_form`(name,email,password) VALUES('$name','$email','$pass')") or die ('query failed');
            $message[] = 'registered successfully';
        }

    }







?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="register-form.css">
</head>
<body>

    <?php
        if(isset($message)){
            foreach($message as $message){
                echo '<div class = "message" onclick="this.remove();">'.$message.'</div>';
            }
        }
    
    
    
    ?>


    <div class="form-container">
        <form action="" method ="post">
            <h3>Register Now</h3>
            <input type="text" name = "name" required placeholder = "enter name" class = "box">
            <input type="text" name = "email" required placeholder = "enter email" class = "box">
            <input type="password" name = "password" required placeholder = "enter password" class = "box">
            <input type="password" name = "cpassword" required placeholder = "enter confirm password" class = "box">
            <input type="submit" name = "submit" class = "btn" value = "Register Now">
            <p>Already have an account <a href="login-form.php">Login Now</a></p>

        </form>


    </div>
</body>
</html>