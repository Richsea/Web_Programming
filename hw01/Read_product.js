getInitialTable();

function initialTable(pname, price, amount, img_dir, total_value)
{
    // choose
    var add_tr = document.createElement('tr');
    var add_td = document.createElement('td');
    var add_input = document.createElement('input');
    add_input.setAttribute('type', 'checkbox');
    //add_input.setAttribute('onclick', 'update_Choose_Product(' + ')');
    add_td.appendChild(add_input);  // 한줄로 하는것보다 여백 존재
    add_tr.appendChild(add_td);

    // product_name
    add_td = document.createElement('td');
    add_td.appendChild(document.createTextNode(pname));            
    add_tr.appendChild(add_td);
                            
    // show_img
    add_td = document.createElement('td');                 
    add_input = document.createElement('button');
    var add_a = document.createElement('a');
    add_a.setAttribute('href', img_dir);
    add_a.appendChild(document.createTextNode('미리보기'));
    add_input.appendChild(add_a);
    add_td.appendChild(add_input);
    add_tr.appendChild(add_td);
    
    // price
    add_td = document.createElement('td');
    add_td.appendChild(document.createTextNode(price));
    add_tr.appendChild(add_td);
    
    // amount
    add_td = document.createElement('td');
    add_input = document.createElement('input');
    add_input.setAttribute('type', 'number');
    add_input.setAttribute('value', amount);
    add_input.setAttribute('max', amount);
    add_input.setAttribute('min', 0);
    add_td.appendChild(add_input);
    add_input = document.createElement('input');
    add_input.setAttribute('type', 'button');
    add_input.setAttribute('value', '변경');
    add_td.appendChild(add_input);
    add_tr.appendChild(add_td);
    
    // total_value
    add_td = document.createElement('td');
    add_td.appendChild(document.createTextNode(total_value));
    add_tr.appendChild(add_td);
    
    // make file    
    document.getElementById("tbody").appendChild(add_tr);   
}

function getInitialTable()
{
    var size = document.getElementsByTagName('ol').length;
    
    for(var i=0; i < size; i++)
    {
        var test = document.getElementsByClassName(String(i))[0];
        var pname = document.getElementsByClassName(String(i))[0].innerHTML;
        var price = document.getElementsByClassName(String(i))[1].innerHTML;
        var amount = document.getElementsByClassName(String(i))[2].innerHTML;
        var img_dir = document.getElementsByClassName(String(i))[3].innerHTML;
        var total_value = document.getElementsByClassName(String(i))[4].innerHTML;
        
        initialTable(pname, price, amount, img_dir, total_value);
    }

}

function update_Choose_All()
{

}

function update_Choose_Product(num)
{

}