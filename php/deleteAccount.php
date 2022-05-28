<?php 
    session_start();
    if(!isset($_SESSION['name']))
    {
        echo "<script type='text/javascript'>window.location.href = './login.php'; </script>";
    }
    include_once "./config.php";
    $name = $_SESSION['name'];
    $sql = "DELETE FROM users WHERE username = '{$name}'";
    mysqli_query($conn, $sql) or die("An error occurred");
    if(file_exists('./user_profile/'.$_SESSION['profile']))
    {
        unlink('./user_profile/'.$_SESSION['profile']);
    }
    echo "<script type='text/javascript'>window.location.href = './logout.php'; </script>";
?>