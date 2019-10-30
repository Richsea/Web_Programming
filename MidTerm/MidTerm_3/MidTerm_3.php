<?php
    $data_file = fopen("./data.txt", "a+");
    $id = htmlspecialchars($_POST['id']);
    $name = htmlspecialchars($_POST['name']);
    $phone = htmlspecialchars($_POST['phone']);
    $gender = htmlspecialchars($_POST['gender'][0]);
    $hobby = getHobbyData();

    
    $inputData = "id:" . $id . "\r\nname:" . $name . "\r\nph:" . $phone . "\r\ngender:" . $gender . "\r\n";
    $i = 0;
    while(true)
    {
        $inputData .= $hobby[$i];

        if($i+1 < count($hobby))
            $inputData .= "/";
        else break;
        $i++;
    }
    $inputData .= "\r\n";
    fwrite($data_file, $inputData);

    echo "저장을 성공하였습니다.";
    
    function getHobbyData()
    {
        $hobby;
        $i = 0;

        while(true)
        {
            if($i > count($_POST['hobby']) -1) break;
            
            $hobby[] = htmlspecialchars($_POST['hobby'][$i]);
            $i++;
        }

        return $hobby;
    }
?>