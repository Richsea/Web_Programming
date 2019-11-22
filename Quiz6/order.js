let infoArray = new Array();

function search()
{
    let title_str = $("#title").val();
    let price_str = Number($("#price").val());
    let radio = $("input[name=sort]:checked").val();
    let dataCheck = new Array();

    if(radio == null)
    {
        return;
    }

    if($.trim(title_str) == "" && $.trim(price_str) == 0)
    {
        alert("Enter the keywords of list that you want to search");
        return;
    }

    for(let i=0; i < infoArray.length; i++)
    {
        if(infoArray[i]["title"].indexOf(title_str) != -1 && Number(infoArray[i]["price"]) >= price_str)
        {
            dataCheck.push(infoArray[i]);
        }
    }

    sort(dataCheck, radio);
    
    display(dataCheck);
}

function sort(array, radio)
{
    return array.sort((e1,e2)=>{
        if(radio === "title")
        {
            return e1["title"] > e2["title"] ? 1 : -1;
        }
        else
        {
            return parseInt(e1["price"]) > parseInt(e2["price"]) ? 1 : -1;
        }
    })
}

function display(array)
{
    $("#bb").css("display", "none");
    $("#display ul").empty();
    
    for(let i = 0; i < array.length; i++)
    {
        let list = $('<li>' + array[i]["title"] + ' : ' + array[i]["price"] + '</li>')
        $('#display ul').append(list);
    }
}

window.onload = function()
{
    let dataList = $("#bb tr td");

    for(let i = 0; i < dataList.length/2; i++)
    {
        let arr = new Array();
        arr['title'] = dataList[i*2].innerText;
        arr['price'] = dataList[i*2+1].innerText;

        infoArray.push(arr);
    }
}