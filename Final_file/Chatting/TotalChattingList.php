<?php
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';

    $connect = mysqli_connect($host, $user, $pw, $dbName);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
    <title>Chatting List</title>
    <link rel="stylesheet" type="text/css" href="TotalChattingList.css"/>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <h2>Chatting List</h2>
    <div id="all_total">
<?php
    $data_dir = "./ChattingDB/";
    $list_file = fopen($data_dir . "chattinglist.txt", "r");

    $chattingList = read_File();

    if(count($chattingList) <= 0)
    {
        echo "<script>alert('no chatting room exist'); location.replace('./MainPage.html');</script>";
        return;
    }

    function read_File()
    {
        global $list_file;

        $data = array();
        while(!feof($list_file))
        {
            $list = fgets($list_file);
            $list = str_replace("\r\n", "", $list);

            if(strlen($list) == 0) continue;

            $data[] = explode("|", $list);
        }
        
        return $data;
    }

    for($i=0; $i < count($chattingList); $i++)
    {
?>
        <div id="<?php echo $chattingList[$i][0] ?>">
<?php
            echo $chattingList[$i][0];
?>
        </div>
<?php
    }
?>
    <script src="TotalChattingList.js"></script>
</body>
</html>
