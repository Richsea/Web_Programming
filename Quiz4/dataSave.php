<?php
    $data_file = fopen("./data.txt", 'a+');
    $fileName = htmlspecialchars($_POST['fname']);
    $fileData = htmlspecialchars($_POST['word']);

    $saveData = $fileName . "\n" . $fileData . "\n";

    fwrite($data_file, $saveData);


    echo "저장되었습니다.";

        
?>