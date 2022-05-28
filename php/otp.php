<?php
    session_start();
    if(isset($_SESSION['name']))
    {
        header("Location: ./users.php");
    }
    if(isset($_SESSION['accActive']))
    {
        $msg = 'accActive';
        $target_link = './activateaccount.php';
    }
    else if(isset($_SESSION['resetPass']))
    {
        $msg = 'resetPass';
        $target_link = './reset.php';
    }
    else
    {
        header("Location: ./signup.php");
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
        <a class="btn">One Time Password</a>
        <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
        <br>
        <p><img class="icon" src="../images/signup-icon.png"></p>
        <br><br>

        <form action="<?php echo $target_link ?>" method="post" autocomplete="off">
            <label for="OTP">
                OTP
            </label> 
            <br/><br/>
            <input type="number" id="OTP" name="otp" placeholder="Enter OTP" required />
            <br/><br/><br/>
            <div class="error"> <?php echo $_SESSION[$msg]; ?> </div>
            <br/><br/>
            <input type="submit" name="verify" value="Verify" />
        </form>
    </div>
</body>
</html>
