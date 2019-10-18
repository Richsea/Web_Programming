<?php
    $data_file = fopen("./data.txt", 'r');

    $filename = htmlspecialchars($_POST['fname']);
    $word = htmlspecialchars($_POST['word']);

    $infoArray = array();
    makeArrayFile();

    while(true)
    {
        if($filename == "" && $word == "")
        {
            echo "Enter the keywords of list that you want to search.";
        break;
        }

        if($filename == "")
        {
            echo "<ul>";
            $arr_key = array_keys($infoArray);

            for($i = 0; $i < count($infoArray); $i++)
            {
                if(!strpos($infoArray[$arr_key[$i]], $word)) continue;

                echo "<li>" . $arr_key[$i] . " : " . $infoArray[$arr_key[$i]] . "</li>";
            }
            echo "</ul>";
            break;
        }

        if($word == "")
        {
            echo "<ul>";

            if(array_key_exists($filename, $infoArray))
                echo "<li>" . $filename . " : " . $infoArray[$filename] . "</li>";
            
            echo "</ul>";
            break;
        }

        echo "<ul>";

        if(array_key_exists($filename, $infoArray))
        {
            if(strpos($infoArray[$filename], $word))
                echo "<li>" . $filename . " : " . $infoArray[$filename] . "</li>";
        }

        echo "</ul>";
        break;
    }

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
            $infoArray[$list_array[$i*2]] = $list_array[$i*2+1];
        }
    }
?>