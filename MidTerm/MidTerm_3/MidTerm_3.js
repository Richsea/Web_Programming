function submitButton()
{
    var id = document.getElementById('id').value;

    if(id == "")
    {
        alert("아이디를 입력해 주세요!");
        return false;
    }

    var name = document.getElementById('name').value;
    var textType = /[ㄱ-ㅎ|ㅏ-ㅣ|가-힣|a-zA-Z]/;

    for(var i = 0; i < name.length; i++)
    {
        if(!textType.test(name.charAt(i)))
        {
            alert("이름은 문자만 입력해 주세요!");
            return false;
        }
    }
    
    var phone = document.getElementById('phone').value;
    var textType = /[0-9]/;

    if(phone == "")
    {
        alert("전화번호 또는 숫자만 입력해주세요!");
        return false;
    }

    for(var i = 0; i < phone.length; i++)
    {
        if(!textType.test(phone.charAt(i)))
        {
            alert("전화번호 또는 숫자만 입력해주세요!");
            return false;
        }
    }

    var gender = document.getElementsByName('gender[]');
    var isChecked = false;

    for(var i = 0; i < gender.length; i++)
    {
        if(gender[i].checked)
        {
            isChecked = true;
            break;
        }
    }

    if(!isChecked)
    {
        alert("성별을 선택하세요!");
        return false;
    }

    var hobby = document.getElementsByName('hobby[]');
    checkedHobby = new Array();

    for(var i = 0; i < hobby.length; i++)
    {
        if(hobby[i].checked) checkedHobby.push(i);
    }

    if(checkedHobby.length < 2)
    {
        alert("관심분야는 두 개 이상 고르세요!");
        return false;
    }

    return true;
}