<?php
    session_start();

    $user_id = $_SESSION['user_id'];
    $r_name = $_SESSION['current_room'];
    
    $host = 'localhost';
    $user = 'root';
    $pw = '201402377';
    $dbName = 'chatting';

    $connect = mysqli_connect($host, $user, $pw, $dbName);

    if(mysqli_connect_errno($connect))
    {
        echo "failed connection to DB: " . mysqli_connect_error();
        return;
    }
    mysqli_select_db($connect, $dbName) or die('DB failed');

    $sql = "INSERT INTO " . $r_name . " VALUES ( null, '" . $user_id . "', '" . $_GET['data'] . "')";

    $result = mysqli_query($connect, $sql);
?>
<table>
<?php
    $sql = "SELECT * FROM " . $r_name;
    $result = mysqli_query($connect, $sql);

    while($row = mysqli_fetch_array($result))
    {
?>
        <tr>
            <td><?php echo $row[1] . ": " ?></td>
            <td><?php echo $row[2] ?></td>
        </tr>
<?php
    }
    mysqli_close($connect);
?>
</table>