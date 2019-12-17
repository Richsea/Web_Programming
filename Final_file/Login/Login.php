<?php
    $data_dir = "./Data/";
    if(!is_dir($data_dir))
    { 
        echo "<script>alert('id와 pw가 일치하지 않습니다.'); 
        location.replace('./Login.html');</script>";
    }

    $data_file = fopen($data_dir . "members.txt", "a+");
    $user_id = htmlspecialchars($_POST['id']);
    $user_pw = htmlspecialchars($_POST['pw']);

    session_start();
    unset($_SESSION['user_id']);

    if(loginCheck($user_id, $user_pw))
    {
        $_SESSION['user_id'] = $user_id;
        echo "<script>location.replace('../Chatting/MainPage.html');</script>";
    }
    else
    {
        echo "<script>alert('id와 pw가 일치하지 않습니다.'); 
        location.replace('./Login.html');</script>";
    }

    function loginCheck($id, $pw)
    {
        global $data_file;
        
        $list = array();
        while(!feof($data_file))
        {
            $login_info = fgets($data_file);
            $login_info = str_replace("\r\n", "", $login_info);

            if(strlen($login_info) == 0) continue;

            $list[] = explode('|', $login_info);
        }

        for($i = 0; $i < count($list); $i++)
        {
            if($list[$i][0] == $id)
            {
                if($list[$i][1] == $pw)
                {
                    return true;
                }
                break;
            }
        }
        return false;
    }
?>