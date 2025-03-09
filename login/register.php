<?php

include 'connect.php';

if(isset($_POST['registerForm'])){
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password); 

    $checkEmail="SELECT * From users where email='$email'";
    $result=$conn->query($checkEmail);
    if($result->num_rows>0){
        echo "<script>alert('Email already exists!');</script>";
    }

    else{
        $insertQuery="INSERT INTO users(fname,lname,email,password)
                        VALUES ('$fname','$lname','$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: login.php"); 
            } 

            else{
                echo "Error:".$conn->error;
            }
        }


}

if(isset($_POST['loginForm'])){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){
        session_start();
        $row=$result->fetch_assoc();
        $_SESSION['email']=$row['email'];
        header("Location: homepage.php");
        exit();
    }

    else{
        echo "<script>alert('Not Found, Incorrect Email or Password');</script>";
    }
}
?>