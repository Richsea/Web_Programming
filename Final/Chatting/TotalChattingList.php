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
    $sql = "SELECT room_name FROM chattinglist";
    $result = mysqli_query($connect, $sql);

    if(mysqli_num_rows($result) <= 0)
    {
        echo "<script>alert('no chatting room exist'); location.replace('./MainPage.php');</script>";
        return;
    }

    while($db_list = mysqli_fetch_row($result))
    {
?>
        <div id="<?php echo $db_list[0] ?>">
<?php
            echo $db_list[0];
?>
        </div>
<?php
    }
?>
    <script src="TotalChattingList.js"></script>
</body>
</html>
