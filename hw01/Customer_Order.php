<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="utf-8">
    <title>order page</title>
    <link rel="stylesheet" type="text/css" href="Customer_Order.css"/>
</head>
<body>
    <h1>도서 주문 페이지</h1>

    <form action="./update.php" method="POST" enctype="multipart/form-data" onsubmit="return submitCheck();">
    <span><p>구매자 아이디 : <input type="text" id="buyer_id" name="id"></p></span>
    
    <table id="order_box">
        <input type="checkbox" id="choose_all" onclick="update_Choose_All()">모두 선택
        <thead>
        <tr>
            <td>선택</td>
            <td>상품명</td>
            <td>미리보기</td>
            <td>정가</td>
            <td>수량</td>
            <td>합계</td>
        </tr>
        </thead>
        <tbody id="tbody" name="tbody">
            <?php
                $filename = "./data/booklist.txt";
                $fp = fopen($filename, "r");
                while(!feof($fp))
                {
                    $buffer .= fread($fp, 1024);
                }
                $list_array = explode("\n", $buffer);   // give booklist.txt's each line a index :: $list_array의 데이터로 저장될 때 마지막 데이터에 "\n"가 추가로 존재해서 배열이 한줄 더 증가됨
                makeProductTable($list_array);

                fclose($fp);

                function makeProductTable($bookList)
                {
                    $size = count($bookList)-1;
                    for($i=0; $i<$size; $i++)
                    {
                        write_table($bookList[$i], $i);
                    }
                }
                function write_Table($book_data, $obj_num)
                {
                    $list_book_atr = explode("|", $book_data);
                    $pname = htmlspecialchars($list_book_atr[0]);
                    $amount = htmlspecialchars($list_book_atr[2]);
                    $item_value = htmlspecialchars($list_book_atr[1]) * $amount;

                    echo "<tr name='table_line'>";
                    echo "<td><input type='checkbox' name='choose[]' value='" . $pname . "' onclick='update_Choose_Product();'></td>";
                    echo "<td><input type='hidden' name='pname[]' value='" . $pname . "'>" . $pname . "</td>";
                    echo "<td><button><a target='_blank' href='" . htmlspecialchars($list_book_atr[3]) . "'>미리보기</a></button></td>";
                    echo "<td><span name='price'>" . htmlspecialchars($list_book_atr[1]) . "</span></td>";
                    echo "<td><input type='number' name='amount[]' class='" . $amount . "' value='" . $amount . "' max='" . $amount . "' min='0' oninput='isUnderMax();'><input type='button' value='변경' onclick='clickChangeButton();'></td>";
                    echo "<td name='item_value'><span name='value_data'>" . $item_value . "</span></td>";
                    echo "</tr>";
                }
            ?>        
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5" ><strong>선택한 총 상품 금액</strong></td>
                <td id="total_cost" name="total_cost"><span id='cost_data'><?php echo htmlspecialchars(0); ?></span></td>
            </tr>
        </tfoot>
    </table>

    <div id="chosen">총 <span id="chosen_data" name="chosen_data"><?php echo htmlspecialchars(0); ?></span>개 상품 선택</div>
    <span><input type="button" value="삭제하기" onclick="clickRemoveButton();"><input type="submit" value="주문하기" onclick="clickOrderButton();"></span>
    <input type="hidden" id="order_work" name="order_work" value="false">
    </form>
    <!--<?php include './Read_product.php';?>-->
    <script src="Read_product.js"></script>
</body>
</html>