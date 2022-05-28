<?php
    session_start();
    if(isset($_SESSION['name']))
    {
        session_unset();
        session_destroy();
    }
?>
<html>
    <head>
        <title>Logout</title>
        <script type="text/javascript">
            localStorage.clear();
        </script>
    </head>
    <body>
        
    </body>
</html>
<?php
    echo "<script type='text/javascript'>window.location.href='./login.php'</script>";
?> 
