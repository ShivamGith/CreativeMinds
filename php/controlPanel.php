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
    if($_SESSION['role'] != 'A')
    {
        echo "<script type='text/javascript'>window.location.href='./users.php'</script>";
    }
    include_once "config.php";
    $sql = "Select * from users";
    $result = mysqli_query($conn, $sql) or die('Can not get user details');
    $arr = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
        <style>
            #logo
            {
                width: 100vw;
            }
            .Control
            {
                position: relative;
                left: 50vw;
                top: 20px;
                width: 80vw;
                transform: translateX(-50%);
            }
            .Control-option
            {
                text-align: center;
                padding: 10px;
            }
            .Control-option p
            {
                font-size: 20px;
                color: red;
            }
            .btn
            {
                padding: 5px;
                background-image: linear-gradient(to right, green, yellow); 
                border-radius: 10px;
                width: 150px;
                font-size: 15px;
            }
            .btn:hover
            {
                background-image: linear-gradient(to right, yellow, green);
                transition: ease-in-out;
            }
            #user table tr td
            {
                font-size: 20px;
                color: red;
                text-align: center;
                min-width: 100px;
                padding: 5px;
            }
            #user table tr
            {
                outline-width: 1px;
            }
            @media only screen and (max-width: 250px)
            {
                .btn
                {
                    font-size: 10px;
                    width: 100px;
                }
            }
        </style>
        <script>
            function viewUser()
            {
                if(document.getElementById('user').style.display != "block")
                {
                    document.getElementById('user').style.display = "block";
                    document.getElementsByClassName('btn')[0].value = "Hide Users";
                }
                else
                {
                    document.getElementById('user').style.display = "none";
                    document.getElementsByClassName('btn')[0].value = "View Users";
                }
            }
        </script>
    </head>
    <body>
        <header>
            <h1 id="logo">Creative Minds</h1>
        </header>
        <div class="Control">
            <div class="Control-option">
                <p>Control Options</p>
                <br>
                <input type="button" value="View Users" class="btn" onclick="viewUser()">
                <br><br>
                <input type="button" value="Add Question" class="btn">
                <br>
            </div>
        <div>
        <div id="user" style="display: none;">
            <table>
                <tr>
                    <td style='color:black;'>S.No</td>
                    <td style='color:black;'>Username</td>
                    <td style='color:black;'>Nickname</td>
                    <td style='color:black;'>Role</td>
                </tr>
                <script>
                    var itr = 0;
                    var data = <?php echo json_encode($arr); ?>;
                    while(itr < data.length)
                    {
                        document.write("<tr>");
                        document.write("<td style='padding: 2px;'>" + (itr + 1) + "</td>");
                        document.write("<td style='padding: 2px;'>" + data[itr]['username'] + "</td>");
                        document.write("<td style='padding: 2px;'>" + data[itr]['nickname'] + "</td>");
                        document.write("<td style='padding: 2px;'>" + data[itr]['role'] + "</td>");
                        document.write("</tr>");
                        itr += 1;
                    }
                </script>
            </table>
        </div>
    </body>
</html>