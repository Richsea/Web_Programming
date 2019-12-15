<?php
    session_start();    // session 초기화

    // $user = $_SESSION['user_id'];    // 나중에 완성 후 주석 해제 필요
    // $current_room = $_SESSION['current_room'];
    $user_id = "test";
    $current_room = "aa";

?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>-Chatting page</title>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div id="chat"></div>

    <form id="chatmessage">
        <textarea name="message" id="messagetext"></textarea>
    </form>
    
    <div id="button_list">
        <input type="button" value="Add" id="add_chat">
        <input type="button" value="return" id="return_page">
        <input type="button" value="Exit" id="exit_chat">
        <input type="button" value="Important" id="toggle_important">
    </div>

    <script src="chat.js"></script>
    <script src="prototype.js"></script>
</body>
</html>