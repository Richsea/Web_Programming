<?php    
    $scoreList = makeScoreList();
    updateScore();

    header('location:' . $_SERVER['HTTP_REFERER']);
    var_dump($scoreList);

    function makeScoreList()
    {
        $sname = array();
        $credit = array();
        $grade = array();
        $attendance = array();
        $scoreList = array();

        $i = 0;

        while(true)
        {
            if($i > count($_POST['sname_hidden']) - 1) break;
            $sname[] = htmlspecialchars($_POST['sname_hidden'][$i]);
            $credit[] = htmlspecialchars($_POST['credit_hidden'][$i]);
            $attendance[] = htmlspecialchars($_POST['attendance'][$i]);

            $i++;
        }

        foreach($_POST['grade'] as $select)
        {
            $grade[] = htmlspecialchars($select);
        }

        $i = 0;
        while(true)
        {
            if($i > count($sname) - 1) break;

            $scoreList[] = $sname[$i] . "|" . $credit[$i] . "|" . $grade[$i] . "|" . $attendance[$i];
            $i++;
        }

        return $scoreList;
    }

    function updateScore()
    {
        global $scoreList;

        $filename = "./score.txt";
        $fp = fopen($filename, "w");
        
        for($i = 0; $i < count($scoreList); $i++)
        {
            fwrite($fp, $scoreList[$i]);

            if($i+1 < count($scoreList))
            {
                fwrite($fp, "\r\n");
            }
        }
        
        fclose($fp);
    }
?>