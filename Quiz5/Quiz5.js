function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    ev.target.appendChild(document.getElementById(data));
    var img_id = document.getElementById(data).parentNode.getAttribute("id");

    localStorage.setItem("loc", img_id);
}

function readLocalStorage()
{
    if(localStorage.length == 0) return;

    let img_loc = localStorage.getItem("loc");
    let img = 'https://www.w3schools.com/html/img_logo.gif';

    var node = "<img src=\"" + img + "\">";

    document.getElementById(img_loc).innerHTML = node;
}