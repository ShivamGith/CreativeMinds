<?php
    session_start();
    if(!isset($_SESSION['nickname']))
    {
        echo "<script type='text/javascript'>window.location.href='./login.php'</script>";
    }
    if(isset($_SESSION['test']))
    {
        echo "<script type='text/javascript'>window.location.href='./test.php'</script>";
    }
    else
    {
        include_once "./Guidelines.php";
        if(isset($_REQUEST['StartTest']))
        {
            $_SESSION['filename'] = 'Idioms';
            $_SESSION['test'] = 'Idioms';
            echo "<script type='text/javascript'>window.location.href='./test.php'</script>";
        }
    }
?>