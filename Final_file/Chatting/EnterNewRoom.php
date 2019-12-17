<?php
    $data_dir = "./ChattingDB/";
    session_start();
    $user_id = $_SESSION['user_id'];
    
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';

    $r_name = $_GET['room_name'];

    $myChattingList = $user_id . "_chattinglist";
    $user_list = fopen($data_dir . $myChattingList . ".txt", "a+");
    $myList = read_MyFile();

    if(list_Exists($myList, $r_name))
    {
        return;
    }
    else
    {
        fwrite($user_list, $r_name . "|0\r\n");

        $list_file = fopen($data_dir . "chattinglist.txt", "r");

        $data = array();
        while(!feof($list_file))
        {
            $room_name = fgets($list_file);
            $room_name = str_replace("\r\n", "", $room_name);

            if(strlen($room_name) == 0) continue;

            $data[] = explode("|", $room_name);
        }

        $list_file = fopen($data_dir . "chattinglist.txt", "w");
        $list_file = fopen($data_dir . "chattinglist.txt", "a+");
            
        for($i=0; $i < count($data); $i++)
        {
            if($data[$i][0] == $r_name)
            {
                $newNum = $data[$i][1] + 1;
                fwrite($list_file, $data[$i][0] . "|" . $newNum . "\r\n");
            }
            else
            {
                fwrite($list_file, $data[$i][0] . "|" . $data[$i][1] . "\r\n");
            }
        }

        unset($_SESSION['current_room']);
        $_SESSION['current_room'] = $r_name;
    }
    
    function read_MyFile()
    {
        global $user_list;

        $data = array();
        while(!feof($user_list))
        {
            $list = fgets($user_list);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $data[] = explode("|", $list);
        }

        return $data;
    }

    function list_Exists($data, $room)
    {
        for($i = 0; $i < count($data); $i++)
        {
            if($data[$i][0] == $room)
            {
                unset($_SESSION['current_room']);
                $_SESSION['current_room'] = $room;
                return true;
            }
        }
        return false;
    }
?>