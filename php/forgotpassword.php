<?php
    session_start();
    if(isset($_SESSION['name']))
    {
        header("Location: ./users.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
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
    <div class="note">
        <p class="heading">Reset Password</p>
    </div>
    <div class="user-detail" id="reset-password" >
        <a class="exit" href="./login.php"><img src="../images/cancel.png"></a>
        <p class="passlogo"><img src="../images/password.png"></p>
        <br><br>
        
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
            <label for="email">
                Email
            </label> 
            <br/><br/>
            <input type="text" id="emailId" name="email" placeholder=" Type email" onblur="validateEmail()" required />
            <img class="correct" id="correctEmail" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectEmail" src="../images/exclamation.png">
            <br/>
            <div id="emailError"></div>
            <br/><br/><br/>
            
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
            
            <input type="submit" name="resPass" value="Reset Password"/>
            <br><br>
            <a class="btn" href="./signup.php"><p class="createset">Create New</p></a>
        </form>
        
    </div>
</body>
</html>

<?php
    include_once "./config.php";
    if(isset($_POST['resPass']))
    {
        $email = $_POST['email'];
        $new_pass = $_POST['new_pass'];
        $con_pass = $_POST['con_pass'];
        if(!validateEmail($email))
        {
            echo "<script type='text/javascript'>alert('You have entered invalid email');</script>";
        }
        if(!validatePassword($new_pass) || !validatePassword($con_pass))
        {
            echo "<script type='text/javascript'>alert('You have entered invalid password');</script>";
        }
        else if($new_pass != $con_pass)
        {
            echo "<script type='text/javascript'>alert('Password does not match.');</script>";
        }
        else
        {
            $sql = "SELECT * FROM `users` WHERE email='$email'";
            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) <= 0)
            {
                echo "<script type='text/javascript'>alert('This email doesn\'t belong to an account.');</script>";
                echo "<script type='text/javascript'>window.location.href='./forgotpassword.php';</script>";
            }
            else
            {
                $otp = rand(10000000, 99999999);
                $subject = "Reset Password";
                $message = "Your OTP for Password Reset is :- {$otp} Don't share this with any one.";
                $header = "From: digi.prateek10@gmail.com";
                if(mail($email, $subject, $message, $header))
                {
                    $pass = password_hash($new_pass, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO `forgotpassword` (`email`, `password`, `otpPass`, `time`) VALUES ('$email', '$pass', $otp, CURRENT_TIMESTAMP())";
                    $result = mysqli_query($conn, $sql);
                    if(mysqli_affected_rows($conn) > 0)
                    {
                        $_SESSION['resetPass'] = "Check your email for OTP";
                        $_SESSION['emailId'] = $email;
                        echo "<script type='text/javascript'>alert('An OTP has been sent to you mail.');</script>";
                        echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";
                    }
                    else
                    {
                        echo "error";
                    }
                }
                else
                {
                    echo "<script type='text/javascript'>alert('Mail not sent.');</script>"; 
                }
            }
        }
    }
?>