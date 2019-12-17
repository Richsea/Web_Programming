<?php
    $data_dir = "./ChattingDB/";
    session_start();
    $user_id = $_SESSION['user_id'];
    $r_name = $_SESSION['current_room'];

    $user_list = fopen($data_dir . $user_id . "_chattinglist.txt", "a+");
    read_File($user_id, $r_name);

    function read_File($id, $room)
    {
        global $user_list;
        global $data_dir;

        $data = array();
        while(!feof($user_list))
        {
            $list = fgets($user_list);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $data[] = explode("|", $list);
        }
        
        $user_list = fopen($data_dir . $id . "_chattinglist.txt", "w");
        $user_list = fopen($data_dir . $id . "_chattinglist.txt", "a+");

        for($i=0; $i < count($data); $i++)
        {
            if($room == $data[$i][0])
            {
                $imp = $_GET['bool'];
                fwrite($user_list, $data[$i][0] . "|" . $imp . "\r\n");            }else
            {
                fwrite($user_list, $data[$i][0] . "|" . $data[$i][1] . "\r\n");
            }
        }
    }
?>