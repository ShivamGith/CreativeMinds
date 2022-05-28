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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
        <p class="heading">For Students</p>
        <p>
            Solve question,be ready for competitive Exams. 
        </p>
    </div>
    <div class="user-detail" id="SignUp" >
        <a class="btn" href="./login.php">Login</a>
        <a class="btn">SignUp</a>
        <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
        <br>
        <p><img class="icon" src="../images/signup-icon.png"></p>
        <br><br>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">
            <label for="nickName">
                NickName
            </label> 
            <br/><br/>
            <input type="text" id="nickName" name="nick_name" placeholder=" eg. John" onchange="validateUserName('nickName', 'correctNickName', 'incorrectNickName', 'nickNameError')" required />
            <img class="correct" id="correctNickName" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectNickName" src="../images/exclamation.png"> 
            <br/>
            <div id="nickNameError"></div>
            <br/><br/><br/>

            <label for="username">
                Username
            </label> 
            <br/><br/>
            <input type="text" id="username" name="name" placeholder=" eg. john" onchange="validateUserName('username', 'correctUserName', 'incorrectUserName', 'userNameError')" required />
            <img class="correct" id="correctUserName" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectUserName" src="../images/exclamation.png"> 
            <br/>
            <div id="userNameError"></div>
            <br/><br/><br/>

            <label for="password">
                <img class="status-pass" id="showicon" src="../images/show.png" onclick="showPassword('password','showicon','hideicon')">
                <img class="status-pass" id="hideicon" src="../images/hide.png" onclick="showPassword('password','showicon','hideicon')">
                Password
            </label> 
            <br/><br/>
            <input type="password" id="password" name="pass" placeholder=" eg. xyz@#123" onchange="validatePassword()" required />
            <img class="correct" id="correctPassword" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectPassword" src="../images/exclamation.png"> 
            <br/>
            <div id="passwordError"></div>
            <br/><br/><br/>
            
            <label for="emailId">
                Email Id
            </label> 
            <br/><br/>
            <input type="text" id="emailId" name="email" placeholder=" eg. John@gmail.com" onchange="validateEmail()" required />
            <img class="correct" id="correctEmail" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectEmail"src="../images/exclamation.png"> 
            <br/>
            <div id="emailError"></div>
            <br/><br/><br/>
            
            <input type="submit" name="register" value="Create Account" />
        </form>

    </div>
</body>
</html>


<?php
    include_once "./config.php";
    if(isset($_POST['register']))
    {
        $nickname = $_POST['nick_name'];
        $name = strtolower($_POST['name']);
        $pass = $_POST['pass'];
        $email = strtolower($_POST['email']);
        if(isset($nickname) && isset($name) && isset($pass) && isset($email))
        {
            if(!validateName($nickname))
            {
                echo "<script type='text/javascript'>alert('Please enter a valid nickname');</script>";
            }
            else if(!validateName($name))
            {   
                echo "<script type='text/javascript'>alert('Please enter a valid username');</script>";
            }
            else if(!validatePassword($pass))
            {   
                echo "<script type='text/javascript'>alert('Please enter a valid password');</script>";
            }
            else if(!validateEmail($email))
            {   
                echo "<script type='text/javascript'>alert('Please enter a valid email');</script>";
            }
            else
            {
                $sql = "SELECT * FROM `users` WHERE username='$name'";
                $user_result = mysqli_query($conn, $sql);
                $sql = "SELECT * FROM `accounts` WHERE username='$name'";
                $account_result = mysqli_query($conn, $sql);

                if(mysqli_num_rows($user_result) > 0 || mysqli_num_rows($account_result) > 0)
                {
                    echo "<script type='text/javascript'>alert('Username not available.');</script>";
                    echo "<script type='text/javascript'>window.location.href='./signup.php';</script>";
                }
                else
                {
                    $sql = "SELECT * FROM `users` WHERE email='$email'";
                    $user_result = mysqli_query($conn, $sql);
                    $sql = "SELECT * FROM `accounts` WHERE email='$email'";
                    $account_result = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($user_result) > 0 || mysqli_num_rows($account_result) > 0)
                    {
                        echo "<script type='text/javascript'>alert('Email already exist.');</script>";
                        echo "<script type='text/javascript'>window.location.href='./signup.php';</script>";
                    }
                    else
                    {
                        $otp = rand(10000000, 99999999);
                        $subject = "Account Verification";
                        $message = "Your OTP for account verification is:- {$otp} Don't share this with anyone.";
                        $header = "From: digi.prateek10@gmail.com";
                        if(mail($email, $subject, $message, $header))
                        {
                            $pass = password_hash($pass, PASSWORD_DEFAULT);
                            $sql = "INSERT INTO `accounts` (`nickname`, `username`, `password`, `email`, `otp`, `time`) VALUES ('$nickname', '$name', '$pass', '$email', $otp, CURRENT_TIMESTAMP())";
                            $result = mysqli_query($conn, $sql);
                            if(mysqli_affected_rows($conn) > 0)
                            {
                                $_SESSION['accActive'] = "Check your email for OTP";
                                $_SESSION['username'] = $name;
                                echo "<script type='text/javascript'>alert('An OTP has been sent to you mail.');</script>";
                                echo "<script type='text/javascript'>window.location.href='./otp.php';</script>";
                            }
                        }
                        else
                        {
                            echo "<script type='text/javascript'>alert('Mail not sent.');</script>"; 
                        }
                    }
                }
            }
        }
        else
        {
            die("Incomplete Details");
        }
    }
?>
