<?php
    session_start();
    if(!isset($_SESSION['name']))
    {
        echo "<script type='text/javascript'>window.location.href='./login.php'</script>";
    }
    if(isset($_SESSION['test']))
    {
        echo "<script type='text/javascript'>window.location.href='./test.php'</script>";
    }
    if($_SESSION['role'] == 'A')
    {
        echo "<script type='text/javascript'>window.location.href='./admin.php'</script>";
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
        <div class="icon-label">
            <div class="icons">
                <a href="./logout.php"><img class="icon" title="Logout" alt="Logout" src="../images/logout.png" ></a>
                <br>
                <h4>Logout</h4>
            </div>
            <div class="icons">
                <a href="#"><img class="icon" title="<?php echo $_SESSION['name'];?>" alt="<?php echo $_SESSION['name'];?>" src="<?php echo '../user_profile/' . $_SESSION['profile'];?>"; onclick="showUserDetails()"></a>
                <br>
                <h4><?php echo substr($_SESSION['name'], 0, 6);?></h4>
            </div>
            <div class="icons">
                <img class="icon" title="Test Category" alt="Test Category" src="../images/categorize.png" onclick="showAndHide('I-categories', 'I-menu')">
                <br>
                <h4>Test</h4>
            </div>
            <div class="icons">
                <img class="icon" title="Menu" alt="Menu" src="../images/menu.png" onclick="showAndHide('I-menu', 'I-categories')">
                <br>
                <h4>Menu</h4>
            </div>
        </div>
        <navbar id="navigation">
            <div id="I-menu">
                    <a class="menu" href="#home">Home</a>
                    <a class="menu" href="#contact-us">Contact us</a>
                    <a class="menu" href="#about-us">About</a>
            </div>
            <div id="I-categories">
            <a class="categories" href="./reasoning.php">Reasoning</a>
                <a class="categories" href="./Antonyms.php">Antonyms</a>
                <a class="categories" href="./synonyms.php">Synonyms</a>
                <a class="categories" href="./spottingerrors.php">Spotting Errors</a>
                <a class="categories" href="./Idioms.php">Idioms</a>
            </div>
            <div id="I-details">
                <a class="details" href="./uploadProfile.php">Update Profile</a>
                <a class="details" href="./updateName.php">Change Nickname</a>
                <a class="details" href="./updatePassword.php">Change Password</a>
                <a class="details" onclick="confirmAction('Do you really want to Delete your Account ?', './deleteAccount.php')">Delete Account</a>
            </div>
        </navbar>
    </header>
    <main>
        <p class="info-head">
            Welcome <?php echo $_SESSION['nickname']; ?>
        </p>
    </main>
    <div>
        <img class="bg" style="display: none;" src="../images/bg-1.jpeg">
        <img class="bg" style="display: none;" src="../images/bg-2.jpeg">
        <img class="bg" style="display: none;" src="../images/bg-3.jpeg">
        <img class="bg" style="display: none;" src="../images/bg-4.jpeg">
        <script>
            changeImage();
            setInterval(changeImage, 2500);
        </script>
    </div>
    <main>
        <p class="info-head">
            Description 
        </p>
        <p class="info-content">
            This platform is suitable for self learning and improvise skills. We are providing a range of various questions for the practice of technical examination. Here is the best opportunity for a student to learn more and enhance their skills. We are providing a platform for technical learning at free of cost. Try various test and be ready for your technical exams.
        </p>
        <p class="info-foot">
            All The Best.
        </p>
    </main>
    <div class="test-box">
        <div class="test-category">
            <a href="./reasoning.php"><img class="test-images" src="../images/reasoning.png"></a>
            <br>
            <p>Reasoning</p>
        </div>
        <div class="test-category">
            <a href="./Antonyms.php"><img class="test-images" src="../images/Antonyms.png"></a>
            <br>
            <p>Antonyms</p>
        </div>
        <div class="test-category">
            <a href="./Synonyms.php"><img class="test-images" src="../images/Synonyms.png"></a>
            <br>
            <p>Synonyms/p>
        </div>
        <div class="test-category">
            <a href="./spottingerrors.php"><img class="test-images" src="../images/spottingerrors.png"></a>
            <br>
            <p>Spotting Errors</p>
        </div>
        <div class="test-category">
            <a href="./Idioms.php"><img class="test-images" src="../images/Idioms.png"></a>
            <br>
            <p>Idioms</p>
        </div>
    </div>
    <main>
        <p class="info-head">Contact Us</p>
    </main>
    <div id="contact-us">
        <form class="user-detail" action="./feedback.php" method="post" autocomplete="off"> 
            <a class="btn">Feedback</a>
            <br/>
            <label>Email</label>
            <br/>
            <input type="text" name="email" placeholder="ex - john@gmail.com" required>
            <br/><br/>
            <label>Feedback/Suggestion</label>
            <br/>
            <textarea name="feedback" placeholder="Write something....." rows="5" cols="50" required></textarea>
            <br/>
            <input type="submit" value="Send">
        </form>
    </div>
    <div id="about-us">
        <p class="info-head">
            About Us 
        </p>
        <p class="info-content">
            Technical Quiz is a online learning platform. We are here to provide the best quality quizzes for the student to enhance their skills. We are continuosly working on the ways to help students to improvise their skills and do self analysis.
        </p>
        <p class="info-foot">
            Thanks for your support.
        </p>
    </div>
</body>
</html>