<?php
    session_start();
    if(isset($_SESSION['name']))
    {
        echo "<script type='text/javascript'>window.location.href='./php/users.php';</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">    
    <title>Creative Minds : Creative Minds is a online learning platform. We are here to provide the best quality quizzes for the student to enhance their skills. We are continuosly working on the ways to help students to improvise their skills and do self analysis.</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <link rel="stylesheet" type="text/css" href="./css/loginStyle.css">
    <link rel="icon" sizes="180x180" href="./logos/favicon_io/Logo1.jpeg">
    <script src="./js/MyScript.js" type="text/javascript"></script>
    <script text="text/javascript" src="./javascript/script.js"></script>
</head>
<body>

    <header>
        <h1 id="logo">Creative Minds</h1>
        <div class="icon-label">
            <div class="icons">
                <a href="./php/signup.php"><img class="icon" title="Signup" alt="Signup" src="./images/signup-icon.png" ></a>
                <br>
                <h4>Signup</h4>
            </div>
            <div class="icons">
                <a href="./php/login.php"><img class="icon" title="Login" alt="Login" src="./images/user-icon.png" ></a>
                <br>
                <h4>Login</h4>
            </div>
            <div class="icons">
                <img class="icon" title="Test Category" alt="Test Category" src="./images/categorize.png" onclick="showAndHide('I-categories', 'I-menu')">
                <br>
                <h4>Test</h4>
            </div>
            <div class="icons">
                <img class="icon" title="Menu" alt="Menu" src="./images/menu.png" onclick="showAndHide('I-menu', 'I-categories')">
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
                <a class="categories" href="./php/reasoning.php">Reasoning</a>
                <a class="categories" href="./php/Antonyms.php">Antonyms</a>
                <a class="categories" href="./php/Synonyms.php">Synonyms</a>
                <a class="categories" href="./php/spottingerrors.php">Spotting Errors</a>
                <a class="categories" href="./php/Idioms.php">Idioms</a>
            </div>
        </navbar>
    </header>
    <main id="home">
        <p class="info-head">
            Welcome to the Creative Minds.
        </p>
    </main>
    <div>
        <img class="bg" style="display: none;" src="./images/bg-1.jpeg">
        <img class="bg" style="display: none;" src="./images/bg-2.jpeg">
        <img class="bg" style="display: none;" src="./images/bg-3.jpeg">
        <img class="bg" style="display: none;" src="./images/bg-4.jpeg">
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
            <a href="./php/reasoning.php"><img class="test-images" src="./images/reasoning.png"></a>
            <br>
            <p>Reasoning</p>
        </div>
        <div class="test-category">
            <a href="./php/Antonyms.php"><img class="test-images" src="./images/Antonyms.png"></a>
            <br>
            <p>Antonyms</p>
        </div>
        <div class="test-category">
            <a href="./php/Synonyms.php"><img class="test-images" src="./images/Synonyms.png"></a>
            <br>
            <p>Synonyms</p>
        </div>
        <div class="test-category">
            <a href="./php/spottingerrors.php"><img class="test-images" src="./images/spottingerrors.png"></a>
            <br>
            <p>Spotting Errors</p>
        </div>
        <div class="test-category">
            <a href="./php/Idioms.php"><img class="test-images" src="./images/Idioms.png"></a>
            <br>
            <p>Idioms</p>
        </div>
    </div>
    <main>
        <p class="info-head">Contact Us</p>
    </main>
    <div id="contact-us">
        <form class="user-detail" action="./php/feedback.php" method="post"> 
            <a class="btn">Feedback</a>
            <br/>
            <label>Email</label>
            <br/>
            <input type="text" onchange="validateEmail()" name="email" placeholder="ex - john@gmail.com" required>
            <br/><br/>
            <label>Feedback/Suggestion</label>
            <br/>
            <textarea placeholder="Write something....." name="feedback" rows="5" cols="50"></textarea>
            <br/>
            <input type="submit" value="Send">
        </form>
    </div>
    <div id="about-us">
        <p class="info-head">
            About Us 
        </p>
        <p class="info-content">
            Creative Minds is a online learning platform. We are here to provide the best quality quizzes for the student to enhance their skills. We are continuosly working on the ways to help students to improvise their skills and do self analysis.
        </p>
        <p class="info-foot">
            Thanks for your support.
        </p>
    </div>
</body>
</html>
 