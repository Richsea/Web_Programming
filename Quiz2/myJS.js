function add_list()
{
    var add_li = document.createElement('li');  
    var list_str = document.createTextNode(document.getElementById('add_list_name').value);

    add_li.appendChild(list_str);

    document.getElementById("list").appendChild(add_li);
}

function alert_remove()
{
    if(confirm("Are you really going to remove?"))
    {
        var parent = document.getElementById('list');
        parent.removeChild(event.target);
    }

}

function change_list()
{
    var number = document.getElementById('number').value;   
    var text = document.getElementById('text').value;
      
    document.getElementsByTagName('li')[Number(number)-1].innerText = text;
}

document.getElementById('add_button').addEventListener('click', add_list);
document.getElementById('list').addEventListener('click', alert_remove);
document.getElementById('change_button').addEventListener('click', change_list);