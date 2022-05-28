<?php
    session_start();
    if(!isset($_SESSION['filename']) || !isset($_SESSION['test']))
    {
        echo "<script type='text/javascript'>window.location.href='./users.php';</script>";
    }
    include "config.php";
    $sql = "select * from {$_SESSION['filename']}";
    $result = mysqli_query($conn, $sql) or die('Error');
    $arr = mysqli_fetch_all($result);
    $name = $_SESSION['nickname'];
?>

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
        <link rel="stylesheet" type="text/css" href="../css/resultStyle.css">
        <script text="text/javascript" src="../javascript/test.js"></script>
        <script>
            var i = 0;
            var correct = 0;
            var incorrect = 0;
            var nickname = <?php echo json_encode($name) ?>;
            while(i < 30)
            {
                var ans = 'Ans' + i;
                var orgAns = 'orgAns' + i;
                if(localStorage.getItem(ans) && localStorage.getItem(orgAns))
                {
                    if(localStorage.getItem(ans) == localStorage.getItem(orgAns))
                    {
                        correct += 1;
                    }
                    else if(localStorage.getItem(ans) != 0)
                    {
                        incorrect += 1;
                    }
                }
                i += 1;
            }
            var score = (correct * 4) - incorrect;
        </script>
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
                <p class="icon-label"> Result</p>
            </div>
        </header>
        <main>            
            <div class="score">
                <div class="status">
                    <script>
                         if(score > 100)
                        {
                            document.write("Yay! " + nickname + ", you are Rocking. Keep it up !!!");
                        }
                        else if(score > 80)
                        {
                            document.write("Kudos! " + nickname + ", you did an execellent job!!!");
                        }
                        else if(score > 60)
                        {
                            document.write("Bravo! " + nickname + ", you performed good in test!!!");
                        }
                        else if(score > 40)
                        {
                            document.write("We believe you " + nickname + ", you will definitely do better in next test!!!");
                        }
                        else
                        {
                            document.write("Sorry " + nickname + ", you have not passed the test. Try it again!!!");
                        }
                    </script>
                </div>
                <script type='text/javascript'>
                    var percentage = (correct * 100) / 30;
                    document.write("<div class='res'>");
                    document.write("<br><br><p>Total number of Questions : 30</p><br><br>");
                    document.write("<p>Number of Correct Answers : " + correct + "</p><br><br>");
                    document.write("<p>Number of Incorrect Answers : " + incorrect + "</p><br><br>");
                    document.write("<p>Number of unanswered questions : " + (30 - (correct + incorrect))  + "</p><br><br>");
                    document.write("<p>Your Percentage is : " + percentage.toFixed(2) + " %</p><br><br>");
                    document.write("<p>Your Score is : " + score + "/" + 120 + "</p><br><br>");
                    document.write("</div>");
                </script>
                <br><br>
                <input name="review" type="button" value="Review Answer" onclick="preview()">
                <br><br>
            </div>
            <div class="review" id="view">
                <script type="text/javascript">
                    var data = <?php echo json_encode($arr); ?>;
                    var itr = 0;
                    while(itr < 30)
                    {
                        loadQuestions(itr);
                        itr += 1;
                    }
                    localStorage.clear();
                </script>
            </div>
        <main>
    </body>
</html>
<?php
    $username = $_SESSION['name'];
    $nickname = $_SESSION['nickname'];
    $email = $_SESSION['email'];
    $profile = $_SESSION['profile'];
    $role = $_SESSION['role'];
    session_unset();
    $_SESSION['name'] = $username;
    $_SESSION['nickname'] = $nickname;
    $_SESSION['email'] = $email;
    $_SESSION['profile'] = $profile;
    $_SESSION['role'] = $role;
?>