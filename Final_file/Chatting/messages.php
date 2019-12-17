<table>
<?php
    $data_dir = "./ChattingDB/";
    session_start();

    $user_id = $_SESSION['user_id']; 
    $r_name = $_SESSION['current_room'];

    $chat_file = fopen($data_dir . $r_name . ".txt", "a+");

    $data;
    while(!feof($chat_file))
    {
        $list = fgets($chat_file);

        if(strlen($list) == 0) continue;

        $data = explode("\r", $list);
    }

    for($i=0; $i < count($data)-1; $i++)
    {
        $row = explode("|", $data[$i]);
?>
        <tr>
            <td><?php echo $row[0] . ": " ?></td>
            <td><?php echo $row[1] ?></td>
        </tr>
<?php
    }
?>
</table>