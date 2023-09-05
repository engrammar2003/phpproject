<?php

    if(isset($_SESSION['email'])){
        header("location: homepage.php");
        exit;
    }

    require_once 'mysql-db.php';

    $email = $password = "";
    $err =  "";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(empty(trim($_POST['email'])) || empty(trim($_POST['password']))){
            $err = "Please enter email + password";
        }

        else{
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

        }
    
    if(empty($err)){
        $sql = "SELECT email, password FROM register_form WHERE email = ? ";
        $stmt = mysqli_prepare($conn,$sql);
        mysqli_stmt_bind_param($stmt , "s" , $param_email);
        $param_email = $email;

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);
            if(mysqli_stmt_num_rows($stmt) == 1){

                mysqli_stmt_bind_result($stmt , $email, $hashed_password);
                if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password,$hashed_password)){
                        session_start();
                        $_SESSION["email"] = $email;
                        $_SESSION["password"] = $password;
                        $_SESSION["loggedin"] = true;
    
                        header("location:homepage.php");
                    
                    }
                }
                
                   
            }
        }
    }
    
    
    }


   
   
    


?> 













<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login-form.css">
</head>
<body>
    <section class="form-container">

        <form action="homepage.php" method="post">
            <h3>Login Form</h3>
            <input type="text" name = "email" required placeholder = "Email" class = "box">
            <input type="password" name = "password" required placeholder = "Password" class = "box">
            <input type="submit" name = "submit" class = "btn" value = "Login Now">
            <p>Don't have an account <a href="register-form.php">Register Now</a></p>
        </form>

    </section>
</body>
</html>