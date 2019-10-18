<?php
    $data_file = fopen("./data.txt", 'r');

    $filename = htmlspecialchars($_POST['fname']);
    $word = htmlspecialchars($_POST['word']);

    $infoArray = array();
    makeArrayFile();
    printAll();
    

    // 이 함수 진행 후 $infoArray=[[0][0]filename, [0][1]data] 형태로 저장됨
    function makeArrayFile()
    {
        global $infoArray, $data_file;

        while(!feof($data_file))
        {
            $buffer .= fread($data_file, 1024);
        }
        $list_array = explode("\n", $buffer);

        for($i = 0; $i < (count($list_array)-1) / 2; $i++)
        {
            $tempArray = [$list_array[$i*2], $list_array[$i*2+1]];
            array_push($infoArray, $tempArray);
        }
    }

    function printAll()
    {
        global $infoArray;

        echo "<ul>";
        for($i = 0; $i < count($infoArray); $i++)
        {
            echo "<li>" . $infoArray[$i][0] . " : " . $infoArray[$i][1] . "</li>";
        }
        echo "</ul>";
    }
?>