<?php
    $data_dir = "./Data/";
    
    $day = htmlspecialchars($_POST['day']);
    $id = htmlspecialchars($_POST['current_id']);
    $title = htmlspecialchars($_POST['add_title']);
    $desc = htmlspecialchars($_POST['add_desc']);

    $data_file = fopen($data_dir . $id . "_" . $day . ".txt", "a+");

    $inputData = $id . "|" . $title . "|" . $desc . "\r\n";

    fwrite($data_file, $inputData);
    echo "<script>location.replace('./ToDoList.html');</script>";
    
?>