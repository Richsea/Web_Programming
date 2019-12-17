<?php
    $data_dir = "./ChattingDB/";

    session_start();
    $user_id = $_SESSION['user_id'];

    $list_file = fopen($data_dir . "chattinglist.txt", "a+");
    $user_list = fopen($data_dir . $user_id . "_chattinglist.txt", "a+");

    $r_name = $_GET['room_name'];

    if(fileExist($r_name))
    {
        echo json_encode("db exist");
        return;
    }
    
    fwrite($list_file, $r_name . "|1\r\n");
    fwrite($user_list, $r_name . "|0\r\n");
    fopen($data_dir . $r_name . ".txt", "w");

    unset($_SESSION['current_room']);
    $_SESSION['current_room'] = $r_name;

    echo json_encode("success");

    
    function fileExist($r_name)
    {
        global $list_file;

        while(!feof($list_file))
        {
            $room_name = fgets($list_file);
            $room_name = str_replace("\r\n", "", $room_name);

            if(strlen($room_name) == 0) continue;

            $list = explode("|", $room_name);
            
            if($list[0] == $r_name)
            {
                return true;
            }
        }
        return false;
    }
?>