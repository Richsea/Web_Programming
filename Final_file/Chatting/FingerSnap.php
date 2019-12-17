<?php
    $data_dir = "./ChattingDB/";
    session_start();
    $user_id = $_SESSION['user_id'];

    $myChattingList = $user_id . "_chattinglist";

    $list_file = fopen($data_dir . "chattinglist.txt", "r");
    $user_list = fopen($data_dir . $myChattingList . ".txt", "r");

    // 파일 분류
    $myAllList = read_File($user_list);
    $myList = removableList($myAllList);

    $size = count($myList);
    $random_num = range(0, $size-1);
    shuffle($random_num);

    $random_num = array_slice($random_num, 0, $size/2);
    sort($random_num);

    $removeList = array();

    for($i=0; $i < count($random_num); $i++)
    {
        array_push($removeList, $myList[$random_num[$i]]);
    }

    /**
     * 삭제 시작
     */
    $myLeftList = array();
    $user_list = fopen($data_dir . $myChattingList . ".txt", "w");
    $user_list = fopen($data_dir . $myChattingList . ".txt", "a+");

    $array_loc = 0;
    $random_loc = 0;
    while(true)
    {
        if($random_loc > count($removeList)-1) break;

        if($myAllList[$array_loc][0] == $removeList[$random_loc])
        {
            $random_loc++;
            $array_loc++;
            continue;
        }
        fwrite($user_list, $myAllList[$array_loc][0] . "|" . $myAllList[$array_loc][1] . "\r\n");
        $array_loc++;
    }

    while(true)
    {
        if($array_loc > count($myAllList)-1) break;
        
        fwrite($user_list, $myAllList[$array_loc][0] . "|" . $myAllList[$array_loc][1] . "\r\n");
        $array_loc++;
    }

    /**
     * chattinglist의 member 수 감소
     */
    $chatList = read_File($list_file);
    $list_file = fopen($data_dir . "chattinglist.txt", "w");
    $list_file = fopen($data_dir . "chattinglist.txt", "a+");
    
    $array_loc = 0;
    $random_loc = 0;
    while(true)
    {
        if($random_loc > count($removeList)-1) break;

        if($chatList[$array_loc][0] == $removeList[$random_loc])
        {
            $newNum = $chatList[$array_loc][1] - 1;
            if($newNum < 1) 
            {
                $random_loc++;
                $array_loc++;
                continue;
            }
            else
            {
                $input = $chatList[$array_loc][0] . "|" . $newNum . "\r\n";
                fwrite($list_file, $input);
                $random_loc++;
                $array_loc++;
            }
            continue;
        }
        $input = $chatList[$array_loc][0] . "|" . $chatList[$array_loc][1] . "\r\n";
        fwrite($list_file, $input);
        $array_loc++;
    }

    while(true)
    {
        if($array_loc > count($chatList)-1) break;

        $input = $chatList[$array_loc][0] . "|" . $chatList[$array_loc][1] . "\r\n";
        fwrite($list_file, $input);
        $array_loc++;
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

    function removableList($list)
    {
        $data = array();
        for($i=0; $i < count($list); $i++)
        {
            if($list[$i][1] == "0")
            {
                $data[] = $list[$i][0];
            }
        }
        return $data;
    }

    unset($_SESSION['current_room']);
?>