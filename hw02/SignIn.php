<?php
    $data_dir = "./Data/";

    if(!is_dir($data_dir)){ mkdir($data_dir, 777); }

    $data_file = fopen($data_dir . "person.txt", "a+");
    $user_id = htmlspecialchars($_POST['user_id']);
    $user_pw = htmlspecialchars($_POST['user_pw']);

    if(overlapCheck($user_id))
    {
        fwrite($data_file, $user_id . "|" . $user_pw . "\r\n");
        echo "<script>alert('회원가입이 완료되었습니다');
        location.replace('./ToDoList.html');</script>";
    }
    else
    {
        echo "<script>alert('id가 중복됩니다. 다시 회원 가입해주세요');
        location.replace('./ToDoList.html');</script>";
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