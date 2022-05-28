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
        include "./Guidelines.php";
        if(isset($_REQUEST['StartTest']))
        {
            $_SESSION['filename'] = 'Reasoning';
            $_SESSION['test'] = 'Reasoning';
            echo "<script type='text/javascript'>window.location.href='./test.php'</script>";
        }
    }
?>