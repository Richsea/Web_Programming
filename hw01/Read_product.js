function update_Choose_All()
{
    var product_list = document.getElementsByName('choose');
    var i = 0;

    if(!document.getElementById('choose_all').checked)
    {
        while(true)
        {
            if(i > product_list.length-1) break;

            product_list[i].checked = false;
            i++;
        }
        setChosenProduct(0);
    }
    else
    {
        while(true)
        {
            if(i > product_list.length-1) break;

            product_list[i].checked = true;
            i++;
        }
        setChosenProduct(product_list.length);
    }

    calculate_Value();
}

function update_Choose_Product()
{
    var product_list = document.getElementsByName('choose');
    var array_chosen = new Array(product_list.length);
    var i = 0;
    var checkCount = 0;     // for choosed product count
    
    while(true)
    {
        if(i > product_list.length-1) break;

        if(product_list[i].checked)
        {
            array_chosen[i] = true;
            checkCount++;
        }
        else 
            array_chosen[i] = false;
        
        i++;
    }

    if(checkCount == product_list.length) document.getElementById("choose_all").checked = true;
    else document.getElementById("choose_all").checked = false;

    calculate_Value(array_chosen);
    setChosenProduct(checkCount);
}

function calculate_Value(array = null)
{
    var newValue = 0;
    var i = 0;
    if(!array)
    {
        if(document.getElementById('choose_all').checked)
        {
            while(true)
            {
                if(i > document.getElementsByName('choose').length-1) break;

                newValue += document.getElementById('price_' + i).textContent * document.getElementById('amount_' + i).value;
                i++
            }
        }
    }
    else
    {
        while(true)
        {
            if(i > document.getElementsByName('choose').length-1) break;

            if(array[i])
                newValue += document.getElementById('price_' + i).textContent * document.getElementById('amount_' + i).value;
            i++
        }  
    }

    var newTotal = document.createElement('span');
    newTotal.setAttribute('id', 'value');
    newTotal.appendChild(document.createTextNode(newValue));
    document.getElementById('total_cost').replaceChild(newTotal, document.getElementById('value'));
}

function setChosenProduct(number)
{
    var newCount = document.createElement('span');
    newCount.setAttribute('id', 'chosen');
    newCount.appendChild(document.createTextNode(number));
    document.getElementById('show_chosen').replaceChild(newCount, document.getElementById('chosen'));
}