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
    <div class="user-detail" id="Login" >
        <a class="btn">Login</a>
        <a class="btn" href="./signup.php">SignUp</a>
        <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
        <br>
        <p><img class="icon" src="../images/user-icon.png"></p>
        <br><br>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off">          
            <label for="username">
                Username
            </label> 
            <br/><br/>
            <input type="text" id="username" name="name" placeholder=" eg. John" onchange="validateUserName('username','correctName','incorrectName','usernameError')" required />
            <img class="correct" id="correctName" src="../images/tick_green.webp">
            <img class="incorrect" id="incorrectName" src="../images/exclamation.png">
            <br>
            <div id="usernameError"></div>
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
            <br/><br/>
           
            <input type="checkbox" name="status" value="remember"><p>Remember me</p>
            <a href="./forgotpassword.php">forgot password?</a>
            <br/><br/>
            <input type="submit" name="Login" id="Log" value="Get Started"/>
        </form>
        
    </div>
</body>
</html>

<?php
    include_once "./config.php";
    if(isset($_POST['Login']))
    {
        $name = strtolower($_POST['name']);
        $pass = $_POST['pass'];
        $sql = "SELECT `nickname`,`username`,`password`,`email`,`profile`,`role` FROM users WHERE username = '{$name}'";
        $result = mysqli_query($conn,$sql) or die("Query Failed");
        if(mysqli_num_rows($result) > 0)
        {
            $data = mysqli_fetch_assoc($result);
            $passEncrypt = $data['password'];
            if(password_verify($pass, $passEncrypt))
            {
                $_SESSION['name'] = $name;
                $_SESSION['profile'] = $data['profile'];
                $_SESSION['nickname'] = $data['nickname'];
                $_SESSION['email'] = $data['email'];
                $_SESSION['role'] = $data['role'];
                echo "<script type='text/javascript'>window.location.href='./users.php';</script>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('Invalid Username or Password');</script>";
            }
        }
        else
        {
            echo "<script type='text/javascript'>alert('Invalid Username or Password');</script>";
        }
    }
?>