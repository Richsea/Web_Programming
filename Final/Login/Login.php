<?php
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';
    $t_name = 'members';

    $connect = mysqli_connect($host, $user, $pw, $dbName);

    if(mysqli_connect_errno($connect))
    {
        echo "failed connectino to DB: " . mysqli_connect_error();    
    }
    else
    {
        echo "success connection to DB <br>";
    }

    mysqli_select_db($connect, $dbName) or die('DB failed');

    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $select = 
    "SELECT member_pw FROM " . $t_name . 
    " WHERE member_id = '" . $id . "'";

    $selectCheck = mysqli_query($connect, $select);

    if(!$selectCheck)
    {
        echo "<script>alert('query 작동 실패'); location.replace('./Login.html');</script>";
    }
    else
    {
        $dbPw = mysqli_fetch_row($selectCheck);

        if($dbPw[0] == $pw)
        {
            session_start();
            unset($_SESSION['user_id']);
            $_SESSION['user_id'] = $id;
            echo "<script>location.replace('../Chatting/MainPage.php');</script>";
        }
        else
        {
            echo "<script>alert('id와 pw가 일치하지 않습니다.'); location.replace('./Login.html');</script>";
        }
    }
?>