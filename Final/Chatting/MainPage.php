<?php
    session_start();
    // $user = $_SESSION['user_id'];    // 나중에 완성 후 주석 해제 필요
    $user = "test";
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
    <title>Main Page</title>
    <link rel="stylesheet" type="text/css" href="MainPage.css"/>
    <script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
</head>
<body>
    <div id="background_Div">
        <div id="first">
            <div class="background_column"></div>
            <div class="background_column">
                <img src="img/powerstone.png" id="power">
            </div>
            <div class="background_column"></div>
            <div class="background_column">
                <img src="img/mindstone.png" id="mind">
            </div>
            <div class="background_column"></div>
        </div>
        <div id="second">
            <div class="background_column">
                <img src="img/realitystone.png" id="reality">
            </div>
            <div class="background_column"></div>
            <div class="background_column"></div>
            <div class="background_column"></div>
            <div class="background_column">
                <img src="img/soulstone.png" id="soul">
            </div>
        </div>
        <div id="third">
            <div class="background_column"></div>
            <div class="background_column">
                <img src="img/spacestone.png" id="space">
            </div>
            <div class="background_column"></div>
            <div class="background_column">
                <img src="img/timestone.png" id="time">
            </div>
            <div class="background_column"></div>
        </div>
    </div>

    <div id="channelList_Div">
        
    </div>

    <div id="add_box">
        <form method="POST">
        <table class="form_box">
            <tr><td><input type="hidden" id="login_id" value="<?php echo($user) ?>"></td></tr>
            <tr>
                <td>room name</td>
                <td><input type="text" id="room_name"></td>
            </tr>
            <tr>
                <td><input type="button" value="add" id="add"></td>
                <td><input type="button" value="cancel" id="cancel"></td>
            </tr>
        </table>
        </form>
    </div>

    <div id="button_Div">
        <input type="button" value="new chatting channel" id="create_channel">
        <input type="button" value="search channel">
    </div>

    <script src="MainPage.js"></script>
</body>
</html>