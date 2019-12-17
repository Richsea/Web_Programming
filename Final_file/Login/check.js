/**
 * html의 입력받은 id와 pw 확인
 */
function dataCheck()
{
    var id = document.getElementById("id").value;
    var pw = document.getElementById("pw").value;

    if(!checkId(id) || !checkPwd(pw))
    {
        return false;
    }

    return true;
}

/**
 * 입력받은 ID가 조건을 만족하는지 확인
 * @param {id} str 
 */
function checkId(str)
{
    let textType = /[a-zA-Z0-9]/;
    let alertCheck = false;

    for(var i = 0; i < str.length; i++)
    {
        if(!textType.test(str.charAt(i)))
        {
            alertCheck = true;
            break;
        }
    }

    if(!checkNull(str) || alertCheck)
    {
        alert("ID는 문자나 숫자로만 입력해주세요");
        return false;
    }
    return true;
}

/**
 * 패스워드가 조건을 만족시키는지 확인
 * @param {pw} str 
 */
function checkPwd(str)
{
    if(!checkNull(str)) 
    {
        alert("비밀번호를 입력해주세요");
        return false;
    }
    return true;
}

/**
 * 빈칸여부 확인
 * @param {data}} str 
 */
function checkNull(str)
{
    if(($.trim(str) == "") || str == null)
        return false;
    return true;
}

function goSignUp()
{
    location.replace("./SignUp.html");
}