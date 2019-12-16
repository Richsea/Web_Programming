<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';

    $r_name = $_GET['room_name'];

    $connect = mysqli_connect($host, $user, $pw, $dbName);

    if(mysqli_connect_errno($connect))
    {
        echo "failed connection to DB: " . mysqli_connect_error();
    }
    
    mysqli_select_db($connect, $dbName) or die('DB failed');

    $myChattingList = $user_id . "_chattinglist";
    $sql = "SELECT room_name FROM " . $myChattingList;

    $result = mysqli_query($connect, $sql);

    while($db_list = mysqli_fetch_row($result))
    {
        if($db_list[0] == $r_name)
        {
            unset($_SESSION['current_room']);
            $_SESSION['current_room'] = $r_name;
            mysqli_close($connect);
            return;
        }
    }

    $sql = "INSERT INTO " . $myChattingList . " VALUES('" . $r_name . "', 0)";
    
    $result = mysqli_query($connect, $sql);

    unset($_SESSION['current_room']);
    $_SESSION['current_room'] = $r_name;

    mysqli_close($connect);
    return;
?>