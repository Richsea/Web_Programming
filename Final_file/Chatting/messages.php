<table>
<?php
    $data_dir = "./ChattingDB/";
    session_start();

    $user_id = $_SESSION['user_id']; 
    $r_name = $_SESSION['current_room'];

    $chat_file = fopen($data_dir . $r_name . ".txt", "a+");

    $data = array();
    while(!feof($chat_file))
    {
        $list = fgets($chat_file);
        $list = str_replace("\r\n", "", $list);

        if(strlen($list) == 0) continue;

        $data[] = explode("|", $list);
    }

    for($i=0; $i < count($data); $i++)
    {
?>
        <tr>
            <td><?php echo $data[$i][0] . ": " ?></td>
            <td><?php echo $data[$i][1] ?></td>
        </tr>
<?php
    }
?>
</table>