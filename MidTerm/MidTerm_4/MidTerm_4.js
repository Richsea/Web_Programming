getTotalAmount();

function getTotalAmount()
{
    var subTotal_list = document.getElementsByName('subTotal[]');
    var score = 0;

    for(var i = 0; i < subTotal_list.length; i++)
    {
        score += Number(subTotal_list[i].textContent);
    }
    
    var totalScore = document.getElementById('totalAmount');
    var totalAmount_node = document.createElement('span');
    totalAmount_node.appendChild(document.createTextNode(score));
    totalScore.replaceChild(totalAmount_node, totalScore.firstChild);

    getTotalAverage(score);
}

function getTotalAverage(totalScore)
{
    var credit_list = document.getElementsByName('credit[]');
    var totalCredit = 0;

    for(var i = 0; i < credit_list.length; i++)
    {
        totalCredit += Number(credit_list[i].textContent);
    }

    var averageScore = totalScore / totalCredit;
    averageScore = getReport(averageScore);
    
    var totalAverage = document.getElementById('averageScore');
    var totalAverage_node = document.createElement('span');
    totalAverage_node.appendChild(document.createTextNode(averageScore));
    totalAverage.replaceChild(totalAverage_node, totalAverage.firstChild);
}

function getReport(score)
{
    if(score >= 4.0)
        return 'A';

    else if(score >= 3.0)
        return 'B';

    else if(score >= 2.0)
        return 'C';

    else if(score >= 1.0)
        return 'D';

    return 'F';
}

function changeGradeSelect()
{
    var eventNode = event.target.parentNode.parentNode;
    
    getSubTotal(eventNode);
    getTotalAmount();
}

function getSubTotal(tr)
{
    const credit = 1, grade = 2, subTotal = 4;

    var list = tr.childNodes;
    var grade_node = list[grade].firstChild;
    var credit_value = list[credit].textContent;
    var grade_value = getGradeScore(grade_node.options[grade_node.selectedIndex].value);
    var subTotal_value = Number(grade_value) * Number(credit_value);

    var span = document.createElement('span');
    span.appendChild(document.createTextNode(subTotal_value));
    list[subTotal].firstChild.replaceChild(span, list[subTotal].firstChild.firstChild);
}

function getGradeScore(grade)
{
    var gradeList = {
        A: 4.0,
        B: 3.0,
        C: 2.0,
        D: 1.0,
        F: 0
    };

    return gradeList[grade];
}

function validationCheck()
{
    var grade_node = document.getElementsByName('grade[]');
    var credit_node = document.getElementsByName('credit[]');
    var attendance_list = document.getElementsByName('attendance[]');
    var maxAttendance;
    
    for(var i = 0; i < grade_node.length; i++)
    {

        maxAttendance = Number(credit_node[i].textContent) * 15;
        
        if(maxAttendance < attendance_list[i].value)
        {
            alert("최대 시수시간을 초과했습니다");
            return false;
        }

        if(getGradeScore(grade_node[i].options[grade_node[i].selectedIndex].value) >= 1.0)
        {
            console.log(maxAttendance * 3/4);
            if(attendance_list[i].value < maxAttendance * 3/4)
            {
                alert("D이상은 해당과목 시수의 3/4이상 출석해야 합니다");
                return false;
            }
        } 
    }
    return true;
}