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

    mysqli_select_db($connect, $dbName) or die('DB failed');

    $tbName = $user_id . "_CHATTINGLIST";

    $sql = "SELECT room_name FROM " . $tbName . " WHERE important=" . 0;
    $result = mysqli_query($connect, $sql);

    $selectedTb = array();

    while($dbList = mysqli_fetch_row($result))
    {
        array_push($selectedTb, $dbList[0]);
    }

    $size = count($selectedTb);

    $removeTb = array();
    $random_num = range(0, $size-1);
    shuffle($random_num);

    for($i=0; $i < $size/2; $i++)
    {
        array_push($removeTb, $selectedTb[$random_num[$i]]);
    }

    /**
     * 삭제 시작
     */
    for($i=0; $i < count($removeTb); $i++)
    {
        $r_name = $removeTb[$i];
        $sql = "DELETE FROM " . $tbName . " WHERE room_name = '" . $r_name . "'";
        $result = mysqli_query($connect, $sql);

        $sql = "SELECT member_num FROM CHATTINGLIST WHERE member_num = 1 and room_name='" . $r_name . "'";
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
            $sql = "UPDATE CHATTINGLIST SET member_num = member_num-1 WHERE room_name='" . $r_name . "'";
            $result = mysqli_query($connect, $sql);
        }
    }

    unset($_SESSION['current_room']);
    mysqli_close($connect);
?>