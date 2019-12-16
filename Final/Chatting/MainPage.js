/**
 * window의 초기 페이지
 */
window.onload = function()
{
    // Main page를 장식할 6가지 image file과 channel 필요
    if(sessionStorage.length == 0)
    {
        sessionStorage.setItem('power', 0);
        sessionStorage.setItem('space', 0);
        sessionStorage.setItem('mind', 0);
        sessionStorage.setItem('reality', 0);
        sessionStorage.setItem('soul', 0);
        sessionStorage.setItem('time', 0);
    }
    else
    {
        this.imgColorChange('power', sessionStorage.getItem('power'));
        this.imgColorChange('space', sessionStorage.getItem('space'));
        this.imgColorChange('mind', sessionStorage.getItem('mind'));
        this.imgColorChange('reality', sessionStorage.getItem('reality'));
        this.imgColorChange('soul', sessionStorage.getItem('soul'));
        this.imgColorChange('time', sessionStorage.getItem('time'));
    }

    this.myChattingRoomList();
}

function myChattingRoomList()
{
    $.ajax({
        url: "myChattingList.php",
        
        success:function(result)
        {
            result = JSON.parse(result);
        }
    })
}

/**
 * Main page에 등록되어 있는 chatting channel의 절반을 랜덤으로 삭제
 */
function doFingerSnap()
{
    $.ajax({
        url: "./FingerSnap.php",

        success:function()
        {
            location.replace("./MainPage.php");
        }
    });
    console.log("hi");

    
    return;
}

/**
 * image가 click 되었을 때의 동작방식 설정
 */
function getStones(id)
{
    if(sessionStorage.getItem(id) == 0)
    {
        imgColorChange(id, 1);
    }
    else
    {
        imgColorChange(id, 0);
    }
}

function imgColorChange(key, value)
{
    let nodeID = "#" + key;

    if(value == 1)
    {
        $(nodeID)
            .css("-webkit-filter", "grayscale(1)")
            .css("-webkit-filter", "grayscale(100%)");
        sessionStorage.setItem(key, 1);
    }
    else
    {
        $(nodeID)
            .css("-webkit-filter", "grayscale(0)");
        sessionStorage.setItem(key, 0);
    }
}

function checkClickedImage()
{
    let stoneList = ["power", "mind", "reality", "soul", "space", "time"];
    let hasAllStone = 1;

    stoneList.forEach(function(key){
        let hasStone = sessionStorage.getItem(key);
        
        if(hasStone == 0)
        {
            hasAllStone = 0;
            return;
        }
    });

    if(hasAllStone == 1)
    {
        doFingerSnap();
    }
}

/**
 * chatting channel 추가
 */
function addChannel()
{
    let room_name = $("#room_name").val();

    $.ajax({
        url:"create_room.php",
        type:"GET",
        data:
        {
            room_name: room_name
        },

        success:function(data)
        {
            close_Box();
            data = JSON.parse(data);
            if(data == "db exist")
            {
                alert("같은 이름으로 생성된 채팅방 존재");
            }
            else if(data == "success")
            {
                location.replace("./chat.php");
            }
        },
        
        error:function(xhr, status, error)
        {
            alert("fail! : " + xhr.status + " : " + xhr.statusText);
        }

    });
}

/**
 * 각 image의 click시 event를 나타내기 위한 eventListener
 */

$(".back_img").click(function(ev){
    let event_id = $(ev.target).attr("id");
    getStones(event_id);

    checkClickedImage();
});

$("#create_channel").click(function(){
    $(".form_box").css("display", "block");
});

$("#show_chattingList").click(function(){
    location.replace('./TotalChattingList.php');
});

/**
 * add box control
 */
$("#cancel").click(function(){
    close_Box();
});

$("#add").click(function(){
    // box에서 add 선택
    if(!room_validation())
        return;
    
    addChannel();
});

function close_Box()
{
    $(".form_box").css("display", "none");
    $("#room_name").val("");
}

function room_validation()
{
    let r_name = $("#room_name").val();

    if($.trim(r_name) == "")
    {
        alert("이름을 다시 입력해주세요");
        close_Box();
        return false;
    }
    return true;
}

/**
 * 엔터로 인한 잘못된 처리 방지
 */
document.addEventListener('keydown', function(event){
    if(event.keyCode === 13)
    {
      event.preventDefault();
    }
}, true);
