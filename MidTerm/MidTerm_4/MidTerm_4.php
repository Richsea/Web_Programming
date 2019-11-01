<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>MidTerm_4</title>
    <link rel="stylesheet" type="text/css" href="MidTerm_4.css"/>
</head>
<body>
    <h1>성적 처리 페이지</h1>
    <form action="./saveData.php" method="POST" enctype="multipart/form-data" onsubmit="return validationCheck();">
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
                    echo "<tr><td colspan=4 class='bold_h2'>총 계</td><td id='totalAmount'><span></span></td></tr>";
                    echo "<tr><td colspan=4 class='bold_h2'>총 평점</td><td id='averageScore'><span></span></td></tr>";
                }

                function write_Table($score)
                {
                    $explode_data = explode("|", $score);
                    $sname = htmlspecialchars($explode_data[0]);
                    $credit = htmlspecialchars($explode_data[1]);
                    $grade = htmlspecialchars($explode_data[2]);
                    $attendance = preg_replace("/[^0-9]*/s", "", htmlspecialchars($explode_data[3]));

                    echo "<tr>";
                    echo "<td><input type='hidden' name='sname_hidden[]' value='" . $sname . "'>" . $sname . "</td>";
                    echo "<td name='credit[]'><input type='hidden' name='credit_hidden[]' value='" . $credit . "'>" . $credit . "</td>";
                    createSelect($grade);
                    echo "<td><input type='number' name='attendance[]' value='" . $attendance . "'></td>";
                    echo "<td name='subTotal[]'><span>" . getSubTotal($grade, $credit) . "</span></td>";
                    echo "</tr>";
                }

                function getSubTotal($score, $credit)
                {
                    $score_point = array(
                        'A' => 4.0,
                        'B' => 3.0,
                        'C' => 2.0,
                        'D' => 1.0,
                        'F' => 0
                    );

                    return $score_point[$score] * $credit;
                }

                function createSelect($grade)
                {
                    $grade_array = ["A", "B", "C", "D", "F"];
                    
                    echo "<td><select name='grade[]' onchange='changeGradeSelect()'>";
                    foreach ($grade_array as &$value)
                    {
                        if($value == $grade)
                        {
                            echo "<option value='" . $grade . "' selected='selected'>" . $grade . "</option>";
                        }
                        else
                        {
                            echo "<option value='" . $value . "'>" . $value . "</option>";
                        }
                    }
                    echo "</td></select>";
                }
            ?>
        </table>
        <br/><br/>
        <input type="submit" value="저장하기">
    </form>
    <script src="MidTerm_4.js"></script>
</body>
</html>