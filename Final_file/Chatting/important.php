<?php
    $data_dir = "./ChattingDB/";
    session_start();
    $user_id = $_SESSION['user_id'];
    $r_name = $_SESSION['current_room'];

    $user_list = fopen($data_dir . $user_id . "_chattinglist.txt", "a+");
    read_File($r_name);

    function read_File($room)
    {
        global $user_list;

        $data = array();
        while(!feof($user_list))
        {
            $list = fgets($user_list);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $data = explode("|", $list);

            if($data[0] == $room)
            {
                echo json_encode($data[1]);
                return;
            }
        }
    }
?>