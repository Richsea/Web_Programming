<?php
    session_start();

    // $user_id = $_SESSION['user_id'];
    // $r_name = $_SESSION['current_room'];
    $user_id = "test";
    $r_name = "aa";

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
    mysqli_select_db($connect, $r_name);

    /**
     * id_chattingList의 데이터를 가져와서 div로 node를 만들어서 표현
     */
?>