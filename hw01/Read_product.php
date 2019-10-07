<?php
    $filename = "./data/booklist.txt";
    $fp = fopen($filename, "r");
    while(!feof($fp))
    {
        $buffer .= fread($fp, 1024);
    }

    $list_array = explode("\n", $buffer);   // give booklist.txt's each line a index :: $list_array의 데이터로 저장될 때 마지막 데이터에 "\n"가 추가로 존재해서 배열이 한줄 더 증가됨
    makeProductTable($list_array);


    //echo "<pre>" . htmlspecialchars($buffer) . "</pre>";
    fclose($fp);

    function setAttribute($book_data)
    {
        $list_book_atr = explode("|", $book_data);
        // HTML을 DOMElement에 추가
        $doc = new DOMDocument();   //??

        echo(
            "<script>
                function initial_table(pname, price, amount, img_dir, total_value)
                {
                    var add_tr = document.createElement('tr');
                    var add_td = document.createElement('td');
                    
                }

            </script>");
        #echo("<script type='text/javascript' src='test.js'>initialTable("echo $pname", "echo $price", "echo $amount", "echo $img_dir", "echo $total_value");</script>");
        echo "hello";
        echo("<script type='text/javascript' src='test.js'>getArray("$list_book_atr");</script>");
        
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