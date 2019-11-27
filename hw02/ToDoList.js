/**
 * login block control
 */
function showLoginBlock()
{
    if($.trim($("#login_name").text()) != "")
        return;
    $("#login_Box").css("display", "block");
}

function closeLoginBlock()
{
    $("#user_id").val("");
    $("#user_pw").val("");
    $("#login_Box").css("display", "none");
}

function login_Info_Check()
{
    let id = $("#user_id").val();
    let pw = $("#user_pw").val();
    let idType = /^([A-Za-z0-9]){6,15}$/;
    let pwType = /^.*(?=^.{8,15})(?=.*\d)(?=.*[a-zA-Z])(?=.*[!@#$%^&+=]).*$/;

    if($.trim(id) == "" || $.trim(pw) == "" || !idType.test(id) || !pwType.test(pw))
    {
        alert("아이디 또는 패스워드 입력양식을 체크해주세요");
        closeLoginBlock();
        return false;
    }
    return true;
}

function login_Ajax()
{
    if(!login_Info_Check()) return false;

    $("#login_name").load("./Data/person.txt", function(data, status, xhr){    //data는 데이터 객체, status는 상태 객체, xhr은 XMHttpRequest 객체와 상태코드
        if(status === "success")
        {
            let account = data.split(/\n|\|/g);
            $("#login_name").text("");
            if(login(account))
                showToDoList();
            closeLoginBlock();
        }
        else
        {
            alert("fail! : " + xhr.status + " : " + xhr.statusText);
        }
    });
}

function login(accounts)
{
    let id = $("#user_id").val();
    let pw = $("#user_pw").val();
    let idCheck = false;
    let pwCheck = false;

    for(let i = 0; i < accounts.length/2 ; i++)
    {
        if(accounts[i*2] === id)
        {
            idCheck = true;
            
            if($.trim(accounts[i*2+1]) !== $.trim(pw)) break;
            sessionStorage.setItem("id", id);
            $("#login_name").text(id);
            $("#login_success").val(id);

            return true;
        }
    }

    if(!idCheck)
    {
        alert("존재하지 않는 회원입니다.");
        return false;
    }

    if(!pwCheck)
    {
        alert("비밀번호가 일치하지 않습니다.");
        return false;
    }

    return false;
}

function logOut()
{
    if($.trim($("#login_name").text()) == "")
        return;
    
    sessionStorage.clear();
    $("#login_name").text("");
    $("#login_success").val("");

    let day = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

    day.forEach(function(val){
        let node = $("#"+val);
        node.empty();
    });

    alert("로그아웃이 되었습니다.");
}

/**
 * to-do-list block control
 */
function showToDoBlock()
{
    let name = $("#login_name").text();

    if($.trim(name) == "")
    {   
        alert("추가하기 위해 로그인 해주세요");
        return;
    }

    $("input[name=current_id]").val(name);
    $("#addList_Box").css("display", "block");
}

function closeToDoBlock()
{
    $("#add_title").val("");
    $("#add_desc").val("");
    $("#addList_Box").css("display", "none");
}

function todoList_Info_Check()
{    
    let title = $("#add_title").val();
    let desc = $("#add_desc").val();

    if($.trim(title) == "" || $.trim(desc) == "")
    {
        alert("title과 description에 빈칸이 존재합니다.");
        return false;
    }

    alert("저장되었습니다");
    return true;
}

/**
 * toDo_Info Block control
 */
function showInfoBlock(e)
{
    let event = e.target;

    if($(event).prop('tagName') != "LI")
        return;

    let day = $(event.parentNode).attr('id');
    let id = $(event).attr("id");

    $('#infoBoxId').val(id)                     // 현재 infoBox가 어떤 리스튼지 알 기 위해 저장
    $('#todoInfo_Box').css("display", "block");
    $("select[name=info_day]").val(day);
    $("#info_title").val($(event).text());
    $("#info_desc").val(sessionStorage.getItem(id));

    // disable 기능
    $("select[name=info_day]").attr('disabled', true);
    $("#info_title").attr('disabled', true);
    $("#info_desc").attr('disabled', true);
    $("#info_edit").attr('disabled', false);
    $("#info_delete").attr('disabled', false);
    $("#info_submit").attr('disabled', true);
}

function closeInfoBlock()
{
    $('#infoBoxId').val("");
    $("#info_title").val("");
    $("#info_desc").val("");
    $('#todoInfo_Box').css("display", "none");
}

function clickEdit()
{
    $("select[name=info_day]").attr('disabled', false);
    $("#info_edit").attr('disabled', true);
    $("#info_delete").attr('disabled', true);
    $("#info_title").attr('disabled', false);
    $("#info_desc").attr('disabled', false);
    $("#info_submit").attr('disabled', false);
}

async function clickSubmit()
{
    let id = $("#login_success").val();
    let toDoID = $("#infoBoxId").val();
    let past_day = $("#" + toDoID).parents("ul").attr("id");
    let day = $("select[name=info_day]").val();
    let title = $("#info_title").val();
    let desc = $("#info_desc").val();

    if($.trim(title) == "" || $.trim(desc) == "")
    {
        alert("title과 description에 빈칸이 존재합니다.");
        return;
    }

    alert("변경되었습니다.");

    let first = await deleteList(id, past_day, toDoID);

    if(first["success"]==="success"){
        let second = await addList(id, day, title, desc, toDoID);

        if(second["success"]==="success"){
            let third = await readDayList(id, day);
        }
    }
}

function clickDelete()
{
    let currentToDo = $('#infoBoxId').val();
    let id = $("#login_success").val();
    let todoId = "#" + currentToDo;
    let day = $(todoId).parents("ul").attr("id");

    alert("삭제되었습니다");

    deleteList(id, day, currentToDo);
}

function addList(id, day, title, desc, toDoID)
{
    return new Promise(function(resolve, reject){
        $.ajax({
            url:"./SaveToDoList_ajax.php",
            type:"GET",
            data:{
                current_id : id,
                day : day,
                add_title : title,
                add_desc : desc,
                toDo_id : toDoID
            },
            success:function(){
                sessionStorage.setItem(toDoID, desc);
                resolve({
                    "success":"success",
                });
            },
    
            error:function(xhr, status, error){
                alert("fail! : " + xhr.status + " : " + xhr.statusText);
            }
        })
    });
}

function deleteList(id, day, currentToDo)
{
    return new Promise(function (resolve, reject){
        $.ajax({
            url:"./RemoveToDo.php",
            type:"GET",
            data:{
                day : day,
                id : id,
                todoId : currentToDo
            },
    
            success:function(result){
                day_arr = JSON.parse(result);
                sessionStorage.removeItem(currentToDo);
                closeInfoBlock();
                applyData(day_arr);
                resolve({
                    "success":"success",
                });
            },
            error:function(xhr, status, error){
                alert("fail! : " + xhr.status + " : " + xhr.statusText);
                reject(xhr.status);
            }
        })
    });
}

function readDayList(id, day)
{
    return new Promise(function (resolve, reject){
        $.ajax({
            url:"./ReadDay.php",
            type:"GET",
            data:{
                current_id : id,
                day : day
            },
    
            success:function(result){
                day_arr = JSON.parse(result);
                closeInfoBlock();
                applyData(day_arr);
                resolve({
                    "success":"success",
                });
            },
            error:function(xhr, status, error){
                alert("fail! : " + xhr.status + " : " + xhr.statusText);
                reject(xhr.status);
            }
        })
    });
}

/**
 * toDo_List control
 */
function showToDoList()
{
    $("#toDo_div").css("display", "block");
    init_toDoList();
}

function init_toDoList()
{
    let day_arr;

    $("#toDo_div").css("display", "block");

    $.ajax({
        url:"./UpdateToDo.php",
        type:"POST",
        data:$("form").serialize(), //data 전송
        
        success:function(data){
            day_arr = JSON.parse(data);
            if(day_arr.length == 0)
                alert("저장된 데이터가 없습니다");
            else
                applyData(day_arr);
        },
        error:function(xhr, status, error){
            alert("fail! : " + xhr.status + " : " + xhr.statusText);
        }
    })
}

function applyData(arr)
{
    for(let key in arr)
    {
        let parentNode = '#' + key;
        $(parentNode).empty();
        arr[key].forEach(function(val){
            let id = val[0];
            let title = val[1];
            let desc = val[2];

            let list = $('<li id=' + id + ' class="draggable_li">'+ title + '</li>')
            $(parentNode).append(list);

            sessionStorage.setItem(id, desc);
        });
    }
}

/**
 * drag & drop
 */
$(function(){
    let past_day;
    let day;

    $(".draggable_ul").sortable({
        connectWith: ".draggable_ul",
        cursor: "pointer",
        helper:'clone',
        
        start: function(event, ui){
            past_day = $(ui.item).parents().attr("id");
        },

        stop: function(event, ui){
            let id = $("#login_success").val();
            let currentNode = $(ui["item"]);
            day = currentNode.parents().attr("id");

            if(past_day === day)
            {
                dragOnList(id, day);
            }
            else
            {
                let toDoID = currentNode.attr("id");
                let desc = sessionStorage.getItem(toDoID);
                dragOnDay(id, past_day, day, toDoID, desc);
            }
        }
    }).disableSelection();
});

function dragOnList(id, day)
{
    modify_DayList(id, day);
}

async function dragOnDay(id, past_day, day, toDoID, desc)
{
    let first = await deleteList(id, past_day, toDoID);
    sessionStorage.setItem(toDoID, desc);

    if(first["success"] === "success")
        await modify_DayList(id, day);
}

async function modify_DayList(id, day)
{
    let nodeList = $("#" + day).children();

    // remove all data
    let first = await clearDay(id, day);

    if(first["success"]==="success"){
        let secondFinish = new Promise(function(resolve, reject){
            resolve({
                "success":"not success",
            });
        });

        for(let item of nodeList)
        {
            let toDoID = $(item).attr("id");
            scondFinish = await addList(id, day, $(item).text(), sessionStorage.getItem(toDoID), toDoID);
        }

        if(secondFinish["success"] === "success")
        {
            let third = await readDayList(id, day);
        }
    }
}

function clearDay(id, day)
{
    return new Promise(function (resolve, reject){
        $.ajax({
            url:"./RemoveAllDay.php",
            type:"GET",
            data:{
                current_id : id,
                day : day
            },
            success:function(){
                resolve({
                    "success":"success",
                });
            },

            error:function(xhr, status, error){
                alert("fail! : " + xhr.status + " : " + xhr.statusText);
                reject(xhr.status);
            }
        })
    });
}


/**
 * start when page load
 */
window.onload = function()
{
    let id = this.sessionStorage.getItem("id");
    $("#login_name").text(id);

    if($.trim(id) != "")
    {
        $("#login_success").val(id);
        showToDoList();
    }
}

document.getElementById('Sun').addEventListener('click', showInfoBlock);
document.getElementById('Mon').addEventListener('click', showInfoBlock);
document.getElementById('Tue').addEventListener('click', showInfoBlock);
document.getElementById('Wed').addEventListener('click', showInfoBlock);
document.getElementById('Thu').addEventListener('click', showInfoBlock);
document.getElementById('Fri').addEventListener('click', showInfoBlock);
document.getElementById('Sat').addEventListener('click', showInfoBlock);
