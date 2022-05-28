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
        <title>Creative Minds : Creative Minds is a online learning platform. We are here to provide the best quality quizzes for the student to enhance their skills. We are continuosly working on the ways to help students to improvise their skills and do self analysis.</title>
        <link rel="icon" sizes="180x180" href="../logos/favicon_io/Logo1.jpeg">
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" type="text/css" href="../css/loginStyle.css">
        <script type="text/javascript" src="../javascript/script.js"></script>
    </head>
    <body>
    <header>
        <h1 id="logo">Creative Minds</h1>
    </header>
    <div class="user-detail">
        <a class="btn">Upload Image</a>
        <a class="exit" href="../index.php"><img src="../images/cancel.png"></a>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" autocomplete="off" enctype="multipart/form-data">
            <br>
            <label for="file">
                <img id='image_input' src="<?php echo '../user_profile/' . $_SESSION['profile']; ?>">
            </label>
            <label>
                <img id='image_uploaded' style="display:none;">
            </label>
            <br><br>
            <input type="file" name='user_profile' id="file" accept=".png, .jpg, .jpeg" hidden="hidden" required onchange="fileUpload()">
            <br><br>
            <label class="btn" for="file">
                Choose Profile
            </label>
            <br><br><br>
            <input type="submit" name='upload' value="Upload">
            <input type="reset" name='reset' value="Reset" onclick='resetFile(<?php echo json_encode($_SESSION['profile']);?>)'>
        </form>
    </div>
    </body>
</html>
<?php
    if(isset($_POST['upload']))
    {
        include_once "./config.php";
        if(!isset($_FILES['user_profile']))
        {
            echo "<script type='text/javascript'>alert('please add profile')</script>";
        }
        else
        {
            $name = explode(".",$_FILES['user_profile']['name']);
            $name = $name[count($name) - 1];
            if($name != 'png' && $name != 'jpg' && $name != 'jpeg')
            {
                echo "<script type='text/javascript'>alert('Image Format is not supported')</script>";
                echo "<script type='text/javascript'>window.location.href='./uploadProfile.php'</script>";
            }
            $name = $_SESSION['name'].".png";
            if(file_exists('../user_profile/'.$name))
            {
                unlink('../user_profile/'.$name);
            }
            if(move_uploaded_file($_FILES['user_profile']['tmp_name'], '../user_profile/'.$name))
            {
                $sql = "update users set profile = '{$name}' where username = '{$_SESSION["name"]}'";
                mysqli_query($conn, $sql) or die('Query Failed');
                $_SESSION['profile'] = $name;
                echo "<script type='text/javascript'>alert('Profile uploaded successfully.')</script>";
                echo "<script type='text/javascript'>window.location.href='./users.php'</script>";
            }
            else
            {
                echo "<script type='text/javascript'>alert('An Error Occurred.')</script>";
            }
        }
    }
?>