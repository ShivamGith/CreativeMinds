<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        echo "<script type='text/javascript'>window.location.href='./login.php';</script>";
    }
    if(!isset($_POST['email']) || !isset($_POST['feedback']))
    {
        echo "<script type='text/javascript'>alert('Missing Data in Form.');</script>";
        echo "<script type='text/javascript'>window.location.href='./users.php';</script>";
    }
    $email = $_POST['email'];
    $feedback = $_POST['feedback'];
    $name = $_SESSION['name'];
    include_once "./config.php";
    if(!validateEmail($email))
    {
        echo "<script type='text/javascript'>alert('Enter a valid Email.');</script>";
    }
    else
    {
        $sql = "INSERT INTO feedback (Suggestion, Email, Username) values ('{$email}', '{$feedback}', '{$name}')";
        $res = mysqli_query($conn, $sql);
        if(mysqli_affected_rows($conn) > 0)
        {
            echo "<script  type='text/javascript'>alert('Thanks for your feedback.');</script>";
        }
        else
        {
            echo "<script  type='text/javascript'>alert('Please try again.');</script>";
        }
    }
    echo "<script  type='text/javascript'>window.location.href='./users.php';</script>";
?>