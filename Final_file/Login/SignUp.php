<?php
    $data_dir = "./Data/";
    if(!is_dir($data_dir)){ mkdir($data_dir, 777); }

    $data_file = fopen($data_dir . "members.txt", "a+");
    $user_id = htmlspecialchars($_POST['id']);
    $user_pw = htmlspecialchars($_POST['pw']);

    if(overlapCheck($user_id))
    {
        fwrite($data_file, $user_id . "|" . $user_pw . "\r\n");
        $data_file = fopen("../Chatting/ChattingDB/" . $user_id . "_chattinglist.txt", "w");
        echo "<script>location.replace('./Login.html');</script>";
    }
    else
    {
        echo "<script>alert('이미 존재하는 id입니다.'); location.replace('./SignUp.html');  </script>";
    }

    function overlapCheck($id)
    {
        global $data_file;

        while(!feof($data_file))
        {
            $id_list = explode('|', fgets($data_file));
            if($id == $id_list[0]) return false;
        }
        return true;
    }

?>