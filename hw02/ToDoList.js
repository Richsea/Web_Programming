/**
 * login block control
 */
function showLoginBlock()
{
    $("#login_Box").css("display", "block");
}

function closeLoginBlock()
{
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
        return;
    }
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
            
            if(accounts[i*2+1].trim() !== pw.trim()) break;
            $("#login_name").text(id);
            return;
        }
    }

    if(!idCheck)
    {
        alert("존재하지 않는 회원입니다.");
        $("#login_name").text("");
        return;
    }

    if(!pwCheck)
    {
        alert("비밀번호가 일치하지 않습니다.");
        $("#login_name").text("");
        return;
    }
}


(function(){
    $("#join_submit").click(function(event){
        $("#login_name").load("./Login/person.txt", function(data, status, xhr){    //data는 데이터 객체, status는 상태 객체, xhr은 XMHttpRequest 객체와 상태코드
            if(status === "success")
            {
                let account = data.split(/\n|\|/g);
                login(account);
                closeLoginBlock();
            }
            else
            {
                alert("fail! : " + xhr.status + " : " + xhr.statusText);
            }
        });
    });
})();