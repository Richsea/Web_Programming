function createTable()
{
    var row = document.getElementById('row').value;
    var column = document.getElementById('column').value;
    var isOk = true;

    if(row == "")
    {
        alert("열의 값을 숫자로 입력하세요");
        isOk = false;
    }
    if(column == "")
    {
        alert("행의 값을 숫자로 입력하세요");
        isOk = false;
    }

    if(!isOk)
    {
        return;
    }


    var newTable = document.createElement('table');

    for(var i = 0; i < row; i++)
    {
        var newRow = document.createElement('tr');
        for(var j = 0; j < column; j++)
        {
            var newColumn = document.createElement('td');
            newRow.appendChild(newColumn);
        }
        newTable.appendChild(newRow);
    }
    
    document.getElementById("showTable").appendChild(newTable);
}

function addRowCol()
{
    var addLine = document.getElementsByName("addLine[]");
    if(addLine[0].checked)
    {

    }    
}

document.getElementById('createButton').addEventListener('click', createTable);