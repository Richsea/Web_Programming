<?php
    $data_dir = "./Data/";

    $day = htmlspecialchars($_GET['day']);
    $id = htmlspecialchars($_GET['current_id']);

    $filename = $data_dir . $id . "_" . $day . ".txt";

    $toDoList = array();
    $result = array();

    $data_file = fopen($filename, "r");


    while(!feof($data_file))
    {
        $listData = fgets($data_file);
        $listData = str_replace("\r\n", "", $listData);

        if(strlen($listData) == 0) continue;

        $toDoList[] = explode('|', $listData);
    }
    $result[$day] = $toDoList;

    echo json_encode($result);
?>