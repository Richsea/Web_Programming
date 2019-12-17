<?php
    $data_dir = "./ChattingDB/";
    session_start();
    // $user_id = $_SESSION['user_id'];
    $user_id = "test";

    $myChattingList = $user_id . "_chattinglist";
    $user_list = fopen($data_dir . $myChattingList . ".txt", "r");
    $myList = read_File();

    $size = count($myList);
    $removeArray = array();
    $random_num = range(0, $size-1);
    shuffle($random_num);

    for($i=0; $i < $size/2; $i++)
    {
        array_push($removeArray, $myList[$random_num[$i]]);
    }
    print_r($myList);
    print_r($removeArray);

    /**
     * 삭제 시작
     */
    for($i=0; $i < count($removeArray); $i++)
    {
        $r_name = $removeArray[$i];
        
        for($j = 0; $j < count($myList); $j++)
        {
            
            // if()
        }
        
    }
    
    function read_File()
    {
        global $user_list;

        $data = array();
        while(!feof($user_list))
        {
            $list = fgets($user_list);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $temp = explode("|", $list);
            if($temp[1] == "0")
            {
                $data[] = $temp[0];
            }
        }

        return $data;
    }

    function removableList($list)
    {
        for($i=0; $i < count($list); $i++)
        {
            if($list[$i] < )
        }
    }

?>