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

    $sql = "SELECT * FROM CHATTINGLIST";

    $result = mysqli_query($connect, $sql);

    if($result)
    {
        while($db_list = mysqli_fetch_row($result))
        {
            if($db_list[0] == $r_name)
            {
                echo json_encode("db exist");
                return;
            }
        }

        // 새로운 chatting방 이름 추가
        $insert = 
        "INSERT INTO CHATTINGLIST
         VALUES('" . $r_name . "', 1)";

        mysqli_query($connect, $insert);

        // user 개개인의 DB chattingList에 chatting room 추가
        $user_chattingList = $user_id . "_CHATTINGLIST";
        $insert = 
        "INSERT INTO " . $user_chattingList . " (room_name)
        VALUES('" . $r_name . "')";

        mysqli_query($connect, $insert);

        // 새로운 chatting방 DB 추가
        $create = 
        "CREATE TABLE " . $r_name . "(
            message_id INTEGER NOT NULL AUTO_INCREMENT,
            user_id char(10) not null,
            message TEXT,
            PRIMARY KEY (message_id)
        )";
        
        mysqli_query($connect, $create);

        unset($_SESSION['current_room']);
        $_SESSION['current_room'] = $r_name;

        mysqli_close($connect);
        
        echo json_encode("success");
    }
?>