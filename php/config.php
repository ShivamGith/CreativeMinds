<?php
    $hostname = "localhost";
    $user = "root";
    $password = "";
    $database = "test";
    $conn = mysqli_connect($hostname, $user, $password, $database);
    if(!$conn) 
    {
        die("Database Connection Failed");
    }

    function validateName($name)
    {
        $length = strlen($name);
        if($name == "")
        {
            return false;
        }
        else if($length >= 50)
        {
            return false;
        }
        else if(!(($name[0] >= 'a' && $name[0] <= 'z') || ($name[0] >= 'A' && $name[0] <= 'Z')))
        {
            return false;
        }
        else if($length < 4)
        {
            return false;
        }
        $index = 1;
        while($index < $length)
        {
            if(!($name[$index] >= 'a' && $name[$index] <= 'z') && !($name[$index] >= 'A' && $name[$index] <= 'Z') && !($name[$index] >= '0' && $name[$index] <= '9') && $name[$index] != '_')
            {
                return false;
            }
            $index++;
        }
        return true;
    }

    function validatePassword($pass)
    {
        $length = strlen($pass);
        if($length >= 20)
        {
            return false;
        }
        if($length < 8)
        {
            return false;
        }
        $index = 0;
        $flagSym = false;
        $flagAlpha = false;
        $flagDigit = false;
        while($index < $length)
        {
            if(($pass[$index] >= 'a' && $pass[$index] <= 'z') || ($pass[$index] >= 'A' && $pass[$index] <= 'Z'))
            {
                $flagAlpha = true;
            }
            else if($pass[$index] >= '0' && $pass[$index] <= '9')
            {
                $flagDigit = true;
            }
            else
            {
                $flagSym = true;
            }
            $index++;
        }
        if($flagAlpha != true || $flagDigit != true || $flagSym != true)
        {
            return false;
        }
        return true;
    }

    function validateEmail($email)
    {
        $length = strlen($email);
        if($length <= 12 || $length >= 100)
        {
            return false;
        }
        else if(substr_count($email,"@gmail.com") != 1)
        {
            if(substr_count($email,"@hotmail.com") != 1)
            {
                return false;
            }
        }
        $index = 1;
        $flag = true;
        while($index < $length)
        {
            if($email[$index] == '@')
            {
                if($flag == true)
                {
                    $flag = false;
                }
                else
                {
                    return $flag;
                }
            }
            $index++;
        }
        return true;
    }
?>

