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
    $sql = "DELETE FROM " . $tbName . " WHERE room_name = '" . $r_name . "'";
    $result = mysqli_query($connect, $sql);

    $sql = "SELECT member_num FROM CHATTINGLIST WHERE room_name = '" . $r_name . "'";
    $result = mysqli_query($connect, $sql);
    $result = mysqli_fetch_row($result);

    if($result[0] == 1)
    {
        $sql = "DELETE FROM CHATTINGLIST WHERE room_name = '" . $r_name . "'";
        mysqli_query($connect, $sql);
        $sql = "DROP TABLE " . $r_name;
        mysqli_query($connect, $sql);
    }
    else
    {
        $sql = "UPDATE CHATTINGLIST SET member_num = member_num - 1 WHERE room_name = '". $r_name . "'";
        mysqli_query($connect, $sql);
    }

    mysqli_close($connect);
?>