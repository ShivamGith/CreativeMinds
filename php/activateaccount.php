<?php 
    session_start();
    if(!isset($_SESSION['username']))
    {
        echo "<script type='text/javascript'>window.location.href='./signup.php';</script>";   
    }
    include "config.php";
    $sql = "DELETE FROM `accounts` WHERE TIMEDIFF(CURRENT_TIMESTAMP(), time) > '00:10'";
    mysqli_query($conn, $sql);    
    if(isset($_POST['otp']))
    {
        $otp = $_POST['otp'];
        $username = $_SESSION['username'];
        $sql = "SELECT * FROM accounts WHERE otp = $otp AND username = '$username'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $data = mysqli_fetch_assoc($result);
            $nickname = $data['nickname'];
            $name = $data['username'];
            $pass = $data['password'];
            $email = $data['email'];
            $sql = "INSERT INTO `users` (`nickname`, `username`, `password`, `email`) VALUES ('$nickname', '$name', '$pass', '$email')";    
            mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn) > 0)
            {
                $sql = "DELETE FROM accounts WHERE username = '$name'";
                mysqli_query($conn, $sql);
                session_unset();
                session_destroy();
                echo "<script type='text/javascript'>alert('Account Verified Successfully')</script>";
                echo "<script type='text/javascript'>window.location.href='./login.php';</script>";   
            }
            else
            {
                echo "<script type='text/javascript'>alert('An error Occurred');</script>";    
                echo "<script type='text/javascript'>window.location.href='./signup.php';</script>";   
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('Please enter valid OTP.');</script>";
            echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Please enter OTP.');</script>";
        echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";
    }
?>