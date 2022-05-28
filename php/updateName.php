<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        echo "<script type='text/javascript'>window.location.href='./login.php'</script>";;
    }
    if(isset($_SESSION['test']))
    {
        echo "<script type='text/javascript'>window.location.href='./test.php'</script>";;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <title>Creative Minds : Creative Minds is a online learning platform. We are here to provide the best quality quizzes for the student to enhance their skills. We are continuosly working on the ways to help students to improvise their skills and do self analysis.</title>
        <link rel="icon" sizes="180x180" href="../logos/favicon_io/Logo1.jpeg">
        <meta name="keywords" content="">
        <meta name="description" content="">
        <meta name="author" content="">

        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
        <script text="text/javascript" src="../javascript/script.js"></script>
    </head>
    <body>
        <header>
            <h1 id="logo">Creative Minds</h1>
        </header>
        <div class="user-detail" id="updateName">
            <a class="btn">Update NickName</a>
            <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">          
                <label for="nickname">
                    Enter New Nickname
                </label> 
                <br/><br/>
                <input type="text" id="nickname" name="nickname" placeholder=" eg. John" onchange="validateUserName('nickname','correctName','incorrectName','usernameError')" required />
                <img class="correct" id="correctName" src="../images/tick_green.webp">
                <img class="incorrect" id="incorrectName" src="../images/exclamation.png">
                <div id="usernameError"></div>
                <br/><br/>
                <input type="submit" name="upload" value="Update"/>
                <br/>
            </form>
        </div>
    </body>
</html>
<?php
    if(isset($_POST['upload']))
    {
        include_once "./config.php";
        if(isset($_POST['nickname']))
        {
            $name = $_POST['nickname'];
            if(!validateName($name))
            {
                echo "<script type='text/javascript'>alert('Invalid Name')</script>";
            }
            else
            {
                $sql = "update users set nickname = '{$name}' where username = '{$_SESSION["name"]}'";
                $result = mysqli_query($conn, $sql) or die('Query Failed');  
                $_SESSION['nickname'] = $name;
                echo "<script type='text/javascript'>alert('Nickname changed successfully.')</script>";
                echo "<script type='text/javascript'>window.location.href='./users.php'</script>";
            }
        }
    }
?>