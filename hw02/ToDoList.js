/**
 * login block control
 */
function showLoginBlock()
{
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
            login(account);
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

            return;
        }
    }

    if(!idCheck)
    {
        alert("존재하지 않는 회원입니다.");
        return;
    }

    if(!pwCheck)
    {
        alert("비밀번호가 일치하지 않습니다.");
        return;
    }
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
 * toDo_List Check
 */
function init_toDoList()
{
    
}

/**
 * start when page load
 */
 window.onload = function()
 {
    $("#login_name").text(sessionStorage.getItem("id"));
 }