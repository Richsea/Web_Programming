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

function checkPwd(str)
{
    if(!checkNull(str)) 
    {
        alert("비밀번호를 입력해주세요");
        return false;
    }
    return true;
}

function checkNull(str)
{
    if(($.trim(str) == "") || str == null)
        return false;
    return true;
}