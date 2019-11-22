<?php
    $data_dir = "./Data/";

    $day = htmlspecialchars($_GET['day']);
    $id = htmlspecialchars($_GET['current_id']);
    $title = htmlspecialchars($_GET['add_title']);
    $desc = htmlspecialchars($_GET['add_desc']);

    $data_id = date('ymdhis');
    $filename = $data_dir . $id . "_" . $day . ".txt";
    
    $toDoList = array();
    $result = array();

    $data_file = fopen($filename, "a+");

    $inputData = $data_id . "|" . $title . "|" . $desc . "\r\n";

    fwrite($data_file, $inputData);

    $data_file = fopen($filename, "r");
    ///////////////////Read Data//////////////////
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