<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>MidTerm_4</title>
    <link rel="stylesheet" type="text/css" href="MidTerm_4.css"/>
</head>
<body>
    <h1>성적 처리 페이지</h1>
    <form action="./MidTerm_3.php" method="POST" enctype="multipart/form-data" onsubmit="return submitButton();">
        <table>
            <tr id="thead">
                <td>과목명</td>
                <td>학점</td>
                <td>점수</td>
                <td>출석</td>
                <td>소계</td>
            </tr>
            <?php
                $filename = "./score.txt";
                $fp = fopen($filename, "r");
                while(!feof($fp))
                {
                    $buffer .= fread($fp, 1024);
                }
                $list_array = explode("\n", $buffer);
                makeproductTable($list_array);

                fclose($fp);

                function makeProductTable($scoreList)
                {
                    $size = count($scoreList);
                    for($i=0; $i<$size; $i++)
                    {
                        write_table($scoreList[$i], $i);
                    }
                }

                function write_Table($score)
                {
                    $explode_data = explode("|", $score);
                    $sname = htmlspecialchars($explode_data[0]);
                    $credit = htmlspecialchars($explode_data[1]);
                    $grade = htmlspecialchars($explode_data[2]);
                    $attendance = htmlspecialchars($explode_data[3]);

                    echo "<td>" . $sname . "</td>";
                    echo "<td>" . $credit . "</td>";
                    echo "<td><select><option value='A'>A</option><option value='B'>B</option><option value='C'>C</option><option value='D'>D</option></select><option value='F'>F</option></td>";
                    echo "<td><input type='number' value='" . $attendance ."'></td>";



                }

                
            ?>
        </table>
        <input type="submit">
    </form>
    <script src="MidTerm_4.js"></script>
</body>
</html>