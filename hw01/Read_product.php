<?php
    $filename = "./data/booklist.txt";
    $fp = fopen($filename, "r");
    while(!feof($fp))
    {
        $buffer .= fread($fp, 1024);
    }

    $list_array = explode("\n", $buffer);   // give booklist.txt's each line a index
    // $list_array의 데이터로 저장될 때 마지막 데이터에 "\n"가 추가로 존재해서 배열이 한줄 더 증가됨

    makeProductTable($list_array);


    echo "<pre>" . htmlspecialchars($buffer) . "</pre>";
    fclose($fp);

    function setAttribute($book_data)
    {
        $list_book_atr = explode("|", $book_data);

        $pname = $list_book_atr[0];
        $price = $list_book_atr[1];
        $amount = $list_book_atr[2];
        $img_dir = $list_book_atr[3];
        $total_value = $price * $amount;

        // HTML을 DOMElement에 추가
        $doc = new DOMDocument();
        $doc->loadXML("<root/>");

        echo(
            "<script>
                function initial_table($

            </script>");
    }
    function makeProductTable($bookList)
    {
        $size = count($bookList)-1;
        for($i=0; $i<$size; $i++)
        {
            setAttribute($bookList[$i]);
        }
    }

?>