<?php
    $data_dir = "./data/";
    $order_file = fopen($data_dir . $_POST['id'] . ".txt", 'a+');
    $data_file = fopen($data_dir . "booklist.txt", "r+");
    $savedData = array();

    $orderList = array();   // 텍스트파일을 만들기 위한 배열
    $book_name = array();
    $book_amount = array();
    $checkedBoxList = array();

    saveValidation();
    makeOrderFile($order_file);

    updateBookList($orderList);    
    fclose($data_file);

    header('location:' . $_SERVER['HTTP_REFERER']);

    // validation check before save data
    function saveValidation()
    {
        global $checkedBoxList;
        global $book_name;
        global $book_amount;

        $i = 0;
        while(true)
        {
            if($i > count($_POST['choose']) - 1) break;
            $checkedBoxList[] = htmlspecialchars($_POST['choose'][$i]);
            $i++;
        }

        $i = 0;
        while(true)
        {
            if($i > count($_POST['pname']) - 1) break;
            $book_name[] = htmlspecialchars($_POST['pname'][$i]);
            $book_amount[] = htmlspecialchars($_POST['amount'][$i]);
            $i++;
        }
    }

    // make id.txt file with order
    function makeOrderFile($filename)
    {
        $i = 0;
        $j = 0;
        global $orderList, $book_name, $book_amount, $checkedBoxList;

        while(true)
        {
            if($i > count($book_name) - 1) break;

            if($book_name[$i] == $checkedBoxList[$j])
            {
                $product_list = array
                (
                    "pname" => $book_name[$i],
                    "amount" => $book_amount[$i]
                );
                
                array_push($orderList, $product_list);

                fwrite($filename, $book_name[$i] . '|' . $book_amount[$i] . "\r\n");
                $j++;
            }
            $i++;
        }
    }

    // update BookList
    function updateBookList($orderList)
    {
        global $data_dir;
        global $data_file;
        global $savedData;
        $result = array();
        
        $i = 0;
        while(!feof($data_file))
        {
            $booklist = explode('|', fgets($data_file));
            $savedData = array($booklist[0], $booklist[1], $booklist[2], $booklist[3]);

            if(!empty($savedData[0]))
            {
                if($savedData[0] == $orderList[$i]['pname'])
                {
                    $savedData[2] -= $orderList[$i]['amount'];
                    $i++;
                }
                $result[] = $savedData[0] . "|" . $savedData[1] . "|" . $savedData[2] . "|" . $savedData[3];
            }

        }
        
        $data_file = fopen($data_dir . "booklist.txt", "w");
        for($i = 0; $i < count($result); $i++)
        {
            fwrite($data_file, $result[$i]);
        }
    }
?>