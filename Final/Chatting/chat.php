<?php
    session_start();    // session 초기화
    if(array_key_exists('username', $_POST))    // 배열 내에 키가 있는지 확인하는 php 함수
    {
        unset($_SESSION['user']);   // 메모리 할당 해지 (프로그램을 가볍게)
        $_SESSION['user'] = $_POST['username'];
    }
    $user = $_SESSION['user']; 
    /**
     *  user가 아니라 mysql에서 id/pw 데이터를 가져올 필요 있음
     */
?>

<html>
<head>
    <title> <?php echo($user) ?> - Chatting</title>
</head>
<body>
    <div id="chat"></div>

    <form id="chatmessage">
        <textarea name="message" id="messagetext"></textarea>
    </form>
    
    <button onclick="addmessage()">Add</button>
    <script src="prototype.js"></script>
    <script src="chat.js"></script>
</body>
</html>