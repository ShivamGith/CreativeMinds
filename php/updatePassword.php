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
        <div class="user-detail">
            <a class="btn">Update Password</a>
            <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
            <br>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">  

                <label for="new_password">
                    <img class="status-pass" id="showicon" src="../images/show.png" onclick="showPassword('password','showicon','hideicon')">
                    <img class="status-pass" id="hideicon" src="../images/hide.png" onclick="showPassword('password','showicon','hideicon')"> 
                    New Password
                </label> 
                <br/><br/>
                <input type="password" id="password" name="new_pass" placeholder=" Type password" onblur="validate()" required />
                <img class="correct" id="correctPassword" src="../images/tick_green.webp">
                <img class="incorrect" id="incorrectPassword" src="../images/exclamation.png">
                <br/>
                <div id="passwordError"></div>
                <br/><br/><br/>
                
                <label for="new_password">
                    Confirm Password
                </label>
                <br/><br/>
                <input type="password" id="new_password" name="con_pass" placeholder=" Retype password" onblur="validate()" required />
                <img class="correct" id="correctNewPass" src="../images/tick_green.webp">
                <img class="incorrect" id="incorrectNewPass" src="../images/exclamation.png">
                <br/>
                <div id="newPasswordError"></div>
                <br/><br/><br/>

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
        if(isset($_POST['new_pass']) && isset($_POST['con_pass']))
        {
            $new_pass = $_POST['new_pass'];
            $con_pass = $_POST['con_pass'];
            if(!validatePassword($new_pass) || !validatePassword($con_pass))
            {
                echo "<script type='text/javascript'>alert('Invalid Password')</script>";
            }
            else if($new_pass != $con_pass)
            {
                echo "<script type='text/javascript'>alert('Password does not match.')</script>";
            }
            else
            {
                $pass = password_hash($new_pass, PASSWORD_DEFAULT);
                $sql = "update users set password = '{$pass}' where username = '{$_SESSION["name"]}'";
                $result = mysqli_query($conn, $sql) or die('Query Failed');
                echo "<script type='text/javascript'>alert('Password set  successfully.')</script>";
                echo "<script type='text/javascript'>window.location.href='./users.php'</script>";
            }
        }
    }
?>