<?php
    $data_dir = "./ChattingDB/";
    session_start();
    $user_id = $_SESSION['user_id'];
    $r_name = $_SESSION['current_room'];

    $myChattingList = $user_id . "_chattinglist";
    $list_file = fopen($data_dir . "chattinglist.txt", "r");
    $user_list = fopen($data_dir . $myChattingList . ".txt", "r");

    // delete from userList
    $myList = read_File($user_list);

    $user_list = fopen($data_dir . $myChattingList . ".txt", "w");
    $user_list = fopen($data_dir . $myChattingList . ".txt", "a+");
    
    for($i=0; $i < count($myList); $i++)
    {
        if($myList[$i][0] == $r_name)
        {
            continue;
        }
        else
        {
            fwrite($user_list, $myList[$i][0] . "|" . $myList[$i][1] . "\r\n");
        }
    }

    // delete from chattinglist
    $chatList = read_File($list_file);

    $list_file = fopen($data_dir . "chattinglist.txt", "w");
    $list_file = fopen($data_dir . "chattinglist.txt", "a+");

    for($i=0; $i < count($chatList); $i++)
    {
        if($chatList[$i][0] == $r_name)
        {
            $newNum = $chatList[$i][1] - 1;
            if($newNum < 1)
            {
                continue;
            }
            else
            {
                $input = $chatList[$i][0] . "|" . $newNum . "\r\n";
                fwrite($list_file, $input);
            }
            continue;
        }
        $input = $chatList[$i][0] . "|" . $chatList[$i][1] . "\r\n";
        fwrite($list_file, $input);
    }

    function read_File($f_name)
    {
        $data = array();
        while(!feof($f_name))
        {
            $list = fgets($f_name);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $data[] = explode("|", $list);
        }

        return $data;
    }
?>