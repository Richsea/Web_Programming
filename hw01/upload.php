<?php
// data file directory :: can save only txt
$data_dir = "./data/";
$data_file = fopen($data_dir . "booklist.txt", 'a+');
$book_name = $_POST['pname'];
$book_price = $_POST['price'];
$book_amount = $_POST['amount'];

// img file directory :: can save .jpg, .jpeg, .png, .gif
$img_dir = "./uploads/";
$img_file = $target_dir . basename($_FILES["update_file"][".txt"]);   //$_FILES["pname"] 에서 pname의 경로 따로 저장 필요>

fwrite($data_file, $book_name . '|' . $book_price . '|' . $book_amount . '|' . $img_file . "\r\n");


if(isset($_POST["submit"]))
{
    echo 2;
}


?>