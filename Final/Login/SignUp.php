<?php
    /**
     * mysql을 이용하여 DB에 회원가입 정보를 저장한다
     */
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';
    $t_name = 'members';

    $connect = mysqli_connect($host, $user, $pw, $dbName);

    if(mysqli_connect_errno($connect))
    {
        echo "failed connection to DB: " . mysqli_connect_error();
    }
    else
    {
        echo "success connection to DB <br>";
    }
    
    mysqli_select_db($connect, $dbName) or die('DB failed');
    
    $id = $_POST['id'];
    $pw = $_POST['pw'];

    $insert = 
    "INSERT INTO " . $t_name . "(member_id, member_pw) 
    VALUES('" . $id . "', '" . $pw . "')";

    $isInsertOK = mysqli_query($connect, $insert);

    if(!$isInsertOK)
    {
        mysqli_close($connect);
        echo "<script>alert('이미 존재하는 id입니다.'); location.replace('./SignUp.html');</script>";
    }
    else
    {
        $list_table = $id . "_CHATTINGLIST";
        $create =
        "CREATE TABLE " . $list_table . "(
            room_name varchar(20) not null,
            important TINYINT(1) DEFAULT 0,
            PRIMARY KEY (room_name)
        );";
        mysqli_query($connect, $create);
        mysqli_close($connect);

        echo "<script>location.replace('./Login.html');</script>";
    }
?>