<?php
    session_start();
    // $user = $_SESSION['user_id'];    // 나중에 완성 후 주석 해제 필요
    $user = "test";

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


    /*
    * 1. 같은 chatting name을 가지고 있는 DB가 있는지 확인
    * 2. chattingList에 chatting 목록 추가
    * 3. id_chattingList DB에 chatting 목록 추가
    * 4. 해당 이름의 DB 생성
    * 5. chatting방으로 들어가기
    */

    
    
?>