<?php
    $data_dir = "./Data/";
    $day = htmlspecialchars($_GET['day']);
    $id = htmlspecialchars($_GET['id']);
    $todoId = htmlspecialchars($_GET['todoId']);

    $filename = $data_dir . $id . "_" . $day . ".txt";
    $data_file = fopen($filename, "r");

    $toDoList = array();
    $result = array();

    while(!feof($data_file))
    {
        $listData = fgets($data_file);
        $listData = str_replace("\r\n", "", $listData);

        if(strlen($listData) == 0) continue;

        $toDoList[] = explode('|', $listData);
    }

    $data_file = fopen($filename, "w");
    $arr = array();
    for($i = 0; $i < count($toDoList); $i++)
    {
        if($toDoList[$i][0] == $todoId) continue;
        array_push($arr, $toDoList[$i]);
        
        fwrite($data_file, $toDoList[$i][0] . "|" . $toDoList[$i][1] . "|" . $toDoList[$i][2] . "\r\n");
    }
    $result[$day] = $arr;

    echo json_encode($result);

?>