<?php
    session_start();    // session 초기
    $current_room = $_SESSION['current_room'];
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title><?php echo $current_room ?>-Chatting page</title>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div id="chatBox"></div>

    <form id="chatmessage" method="POST">
        <textarea name="message" id="messagetext"></textarea>
    </form>
    
    <div id="button_list">
        <input type="button" value="Add" id="add_chat">
        <input type="button" value="return" id="return_page">
        <input type="button" value="Exit" id="exit_chat">
        <input type="button" value="Important" id="toggle_important" class="0">
    </div>

    <script src="chat.js"></script>
    <script src="prototype.js"></script>
</body>
</html>