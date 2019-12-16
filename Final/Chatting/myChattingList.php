<?php
    session_start();

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
    mysqli_select_db($connect, $dbName);

    /**
     * id_chattingList의 데이터를 가져와서 div로 node를 만들어서 표현
     */
    $sql = "SELECT room_name FROM " . $user_id . "_chattinglist";
    $result = mysqli_query($connect, $sql);
    $myList = array();
    
    while($dbList = mysqli_fetch_row($result))
    {
        array_push($myList, $dbList[0]);
    }

    mysqli_close($connect);
    echo json_encode($myList);
?>