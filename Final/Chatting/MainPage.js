/**
 * window의 초기 페이지
 */
window.onload = function()
{
    // Main page를 장식할 6가지 image file과 channel 필요
}

/**
 * Main page에 등록되어 있는 chatting channel의 절반을 랜덤으로 삭제
 */
function doFingerSnap()
{
    /*
    important로 처리가 되어있는 채팅리스트는 삭제하지 않느다.
    */
    return;
}

/**
 * image가 click 되었을 때의 동작방식 설정
 */
function getStones()
{
    /*
    if(image가 클리되어 있는 상태)
        return;
    else
        image click 실행 
    */
    return;
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
            // 생성된 채팅방으로 이동하는 과정 추가
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

// document.getElementById('space').addEventListener('click', getStones);
// document.getElementById('power').addEventListener('click', getStones);
// document.getElementById('time').addEventListener('click', getStones);
// document.getElementById('soul').addEventListener('click', getStones);
// document.getElementById('reality').addEventListener('click', getStones);
// document.getElementById('mind').addEventListener('click', getStones);


$("#create_channel").click(function(){
    $(".form_box").css("display", "block");
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