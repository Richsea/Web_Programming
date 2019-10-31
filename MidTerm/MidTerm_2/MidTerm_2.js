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
    var loc = document.getElementById("addLoc").value;

    if(loc == "")
    {
        if(!addLine[0].checked && !addLine[1].checked)
        {
            alert("추가할위치와 행 또는 열 번호를 숫자로 입력하시고, Radio 버튼을 하나 선택해주세요.");
            return;
        }
        alert("추가할 위치의 행 또는 열의 번호를 숫자로 입력하세요");
        return;
    }

    // row가 행. 가로줄, column이 열, 세로줄
    if(addLine[0].checked)
    {
        if(!isRowExists(loc))
        {
            alert("추가할 위치는 값의 범위를 초과하였습니다. 다시 입력해주세요");
            return;
        }
        addRow(loc); 
    }
    else if(addLine[1].checked)
    {
        if(!isColExists(loc))
        {
            alert("추가할 위치는 값의 범위를 초과하였습니다. 다시 입력해주세요");
            return;
        }
        addCol(loc);
    }
    else
    {
        alert("Radio 버튼을 하나 선택해 주세요");
    }

    return;
}

function addRow(location)
{
    var table = document.getElementById("showTable").firstElementChild;
    var tr_list = table.getElementsByTagName("tr");
    var td_size = tr_list[0].getElementsByTagName("td").length;

    //insertRow, insertCell
    var row = table.insertRow(location-1);

    row.style.backgroundColor = "pink";
    

    for(var i = 0; i < td_size; i++)
    {
        row.insertCell(i);
    }
}

function addCol(location)
{
    var table = document.getElementById("showTable").firstElementChild;
    var tr_list = table.getElementsByTagName("tr");
    var tr_size = tr_list.length;

    for(var i = 0; i < tr_size; i++)
    {
        var temp = tr_list[i].insertCell(location-1);
        temp.style.backgroundColor = "green";
    }
}

function addContent()
{
    var rowValue = document.getElementById("contentRow").value;
    var colValue = document.getElementById("contentCol").value;
    var content = document.getElementById("content").value;
    var table = document.getElementById("showTable").firstElementChild;
    var row = table.getElementsByTagName("tr");

    console.log(table);

    if(!contentErr())
        return;
    
    row[rowValue-1].getElementsByTagName("td")[colValue-1].textContent = content;
}

function contentErr()
{
    var row = document.getElementById("contentRow").value;
    var col = document.getElementById("contentCol").value;
    var content = document.getElementById("content").value;

    if(row == "" && col == "")
    {
        alert("행과 열의 값을 숫자로 입력하세요");
        return false;
    }
    
    if(row == "")
    {
        alert("행의 값을 숫자로 입력하세요");
        return false;
    }
    else if(col == "")
    {
        alert("열의 값을 숫자로 입력하세요");
        return false;
    }

    if(content == "")
    {
        alert("추가할 값을 입력하세요");
        return false;
    }

    return true;
}

function isRowExists(location)
{
    rowSize = getRowSize();

    if(rowSize+1 < location || location == 0)
        return false;
    return true;
}


function isColExists(location)
{
    colSize = getColSize();
    
    if(colSize+1 < location || location == 0)
        return false;
    return true;
}

function getRowSize()
{ 
    return document.getElementById("showTable").firstElementChild.getElementsByTagName("tr").length; 
}
function getColSize()
{ 
    return document.getElementById("showTable").firstElementChild.getElementsByTagName("tr")[0].getElementsByTagName("td").length; 
}