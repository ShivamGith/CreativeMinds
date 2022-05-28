<?php
    session_start();
    if(!isset($_SESSION['filename']) || !isset($_SESSION['test']))
    {
        echo "<script type='text/javascript'>window.location.href='./users.php';</script>";
    }
    include "config.php";
    $sql = "select * from {$_SESSION['filename']}";
    $result=mysqli_query($conn, $sql) or die('Error');
    $arr = mysqli_fetch_all($result);
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
        <link rel="stylesheet" type="text/css" href="../css/testStyle.css">

        <script type='text/javascript'>
            var data = <?php echo json_encode($arr); ?>;
            var index = -1;
            var x;
            
            if(localStorage.getItem('index') == null)
            {
                localStorage.setItem('index', index);
            }
            else
            {
                index = localStorage.getItem('index');
                localStorage.setItem('index', index - 1)
            }
        </script>
        <script type='text/javascript' src="../javascript/test.js"></script>
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
                <p class="icon-label"> <?php echo $_SESSION['test']; ?></p>
            </div>
        </header>
        <div id='timer'></div>
        <div class="block">
            <div class="Q-numbers">
                <script>
                    var itr = 0;
                    while(itr < 30)
                    {
                        itr += 1;
                        document.write("<div class='numbers' onclick='loadQuestionNo(" + itr + ")'>" + itr + "</div>");
                    }
                </script>
            </div>  
            <main>
                <div class="question" onchange="saveAns()">
                    <div class='que' id='que' ></div>
                    <input type='radio' name='ans' value='1'>
                    <label class="option"></label> <br/>
                    <input type='radio' name='ans' value='2'>
                    <label class="option"></label> <br/>                
                    <input type='radio' name='ans' value='3' >
                    <label class="option"></label> <br/>
                    <input type='radio' name='ans' value='4' >
                    <label class="option"></label> <br/>
                </div>
            </main>
        </div>
        <div class='btn-set'>
            <input type='submit' id="previous" value="Prev" onclick="loadprev()">
            <input type='submit' id="next" value="Next" onclick="loadnext()">
            <input type='submit' value="Clear" onclick="clearAns()">
            <input type='submit' id='flag' value="Flag" onclick="setFlag()">
            <script>
                if(!localStorage.getItem('status'))
                {
                    shuffleQuestions();
                    localStorage.setItem('status', 'ready');
                }
                loadnext();
                colorAll();
                startTest();
            </script>            
        </div>     
    </body>
</html>