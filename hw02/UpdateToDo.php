<?php
    $data_dir = "./Data/";
    $id = $_POST['login_success'];
    $day = array("Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat");
    $exist_day = array();

    foreach($day as $value)
    {
        $filename = $data_dir . $id . "_" . $value . ".txt";
        if(file_exists($filename))
        {
            $data_file = fopen($filename, "r");
            $toDoList = array();

            while(!feof($data_file))
            {
                $listData = fgets($data_file);
                $listData = str_replace("\r\n", "", $listData);

                if(strlen($listData) == 0) continue;

                $toDoList[] = explode('|', $listData);
            }
            $exist_day[$value] = $toDoList;
        }   
    }
    
    echo json_encode($exist_day);
?>