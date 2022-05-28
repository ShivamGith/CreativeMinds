<?php
    session_start();
    if(!isset($_SESSION['emailId']))
    {
        echo "<script type='text/javascript'>window.location.href='./forgotpassword.php';</script>";   
    }
    include "config.php";
    $sql = "DELETE FROM `forgotpassword` WHERE TIMEDIFF(CURRENT_TIMESTAMP(), time) > '00:10:00'";
    mysqli_query($conn, $sql);
    if(isset($_POST['otp']))
    {
        $otp = $_POST['otp'];
        $emailId = $_SESSION['emailId'];
        $sql = "SELECT * FROM forgotpassword WHERE otpPass = $otp AND email = '$emailId'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0)
        {
            $data = mysqli_fetch_assoc($result);
            $pass = $data['password'];
            $sql = "UPDATE users SET password = '$pass' WHERE email = '$emailId'";
            mysqli_query($conn, $sql);
            if(mysqli_affected_rows($conn) > 0)
            {
                $sql = "DELETE FROM forgotpassword WHERE email = '$emailId'";
                mysqli_query($conn, $sql);
                session_unset();
                session_destroy();
                echo "<script type='text/javascript'>alert('Password set Successfully')</script>";
                echo "<script type='text/javascript'>window.location.href='./login.php';</script>";   
            }
            else
            {
                echo "<script type='text/javascript'>alert('You are using Invalid OTP');</script>";    
                echo "<script type='text/javascript'>window.location.href='./forgotpassword.php';</script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('You are using Invalid OTP');</script>";    
            echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";   
        }
    }
    else
    {
        echo "<script type='text/javascript'>alert('Please enter OTP.');</script>";
        echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";
    }
?>