<?php
    $data_dir = "./ChattingDB/";
    session_start();

    unset($_SESSION['current_room']);
    $r_name = $_GET['r_name'];
    $_SESSION['current_room'] = $r_name;

    $user_id = $_SESSION['user_id'];

    $list_file = fopen($data_dir . "chattinglist.txt", "a+");

    readAndUpdate($r_name);

    function readAndUpdate($room)
    {
        global $list_file;
        global $data_dir;

        $list = array();
        while(!feof($list_file))
        {
            $room_name = fgets($list_file);
            $room_name = str_replace("\r\n", "", $room_name);

            if(strlen($room_name) == 0) continue;

            $list[] = explode("|", $room_name);
        }

        $list_file = fopen($data_dir . "chattinglist.txt", "w");
        $list_file = fopen($data_dir . "chattinglist.txt", "a+");
        
        for($i=0; $i < count($list); $i++)
        {
            if($room == $list[$i][0])
            {
                $newNum = $list[$i][1] + 1;
                fwrite($list_file, $list[$i][0] . "|" . $newNum . "\r\n");
            }else
            {
                fwrite($list_file, $list[$i][0] . "|" . $list[$i][1] . "\r\n");
            }
        }
    }
?>