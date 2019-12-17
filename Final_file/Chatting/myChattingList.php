<?php
    $data_dir = "./ChattingDB/";
    session_start();

    $user_id = $_SESSION['user_id'];

    $user_list = fopen($data_dir . $user_id . "_chattinglist.txt", "r");
    $data = read_File($user_id);

    $myList = array();

    for($i=0; $i < count($data); $i++)
    {
        array_push($myList, $data[$i][0]);
    }

    function read_File($id)
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

    echo json_encode($myList);
?>