<?php
    session_start();
    // $user = $_SESSION['user_id'];    // 나중에 완성 후 주석 해제 필요
    $user_id = "test";
    
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
        $db_list = mysqli_fetch_row($result);
        if(!empty($db_list))
        {
            for($i = 0; $i < count($db_list); $i++)
            {
                if($db_list[$i] === $r_name)
                {
                    echo json_encode("db exist");
                    return;
                }
            }
        }

        // 새로운 chatting방 이름 추가
        $insert = 
        "INSERT INTO CHATTINGLIST
        VALUES('" . $r_name . "')";

        mysqli_query($connect, $insert);

        // user 개개인의 DB chattingList에 chatting room 추가
        $user_chattingList = $user_id . "_CHATTINGLIST";
        $insert = 
        "INSERT INTO " . $user_chattingList . "(room_name)
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
        
        echo json_encode("success");
    }
?>