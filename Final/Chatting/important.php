<?php
    session_start();
    $user_id = $_SESSION['user_id'];
    $r_name = $_SESSION['current_room'];
    
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

    $tbName = $user_id . "_CHATTINGLIST";
    $sql = "SELECT important FROM " . $tbName . " WHERE room_name = '" . $r_name . "'";

    $result = mysqli_query($connect, $sql);
    mysqli_close($connect);

    echo json_encode(mysqli_fetch_row($result));
?>