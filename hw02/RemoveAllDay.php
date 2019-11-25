<?php
    $data_dir = "./Data/";
    
    $day = htmlspecialchars($_GET['day']);
    $id = htmlspecialchars($_GET['current_id']);

    $data_file = fopen($data_dir . $id . "_" . $day . ".txt", "w");
?>