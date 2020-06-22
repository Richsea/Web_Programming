<?php
    session_start();
    unset($_SESSION['current_room']);
    $r_name = $_GET['r_name'];
    $_SESSION['current_room'] = $r_name;

    $user_id = $_SESSION['user_id'];

    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';

    $connect = mysqli_connect($host, $user, $pw, $dbName);

    if(mysqli_connect_errno($connect))
    {
        echo "failed connection to DB: " . mysqli_connect_error();
        return;
    }

    mysqli_select_db($connect, $dbName) or die('DB failed');

    $result = mysqli_query($connect, $sql);

    mysqli_close($connect);
?>