let lastAmount_arr = new Array(document.getElementsByName('choose').length);
for(var i=0; i < lastAmount_arr.length; i++)
{
    lastAmount_arr[i] = document.getElementsByName('amount')[i].value;
}

/**
 * update all of the table line's checkboxes
 * update total cost and selected product's count
 */
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

/**
 * update selected checkbox
 * update total cost and selected product's count
 */
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

/**
 * calculate every checkbox checked line's total cost
 * @param {table's checkbox checked lines} array 
 */
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

                newValue += getItemValue(i);
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
                newValue += getItemValue(i);
            i++
        }  
    }

    var newTotal = document.createElement('span');
    newTotal.setAttribute('id', 'cost_data');
    newTotal.appendChild(document.createTextNode(newValue));
    document.getElementById('total_cost').replaceChild(newTotal, document.getElementById('cost_data'));
}

/**
 * update checkbox checked count
 * @param {table line} number 
 */
function setChosenProduct(number)
{
    var newCount = document.createElement('span');
    newCount.setAttribute('id', 'chosen_data');
    newCount.appendChild(document.createTextNode(number));
    document.getElementById('chosen').replaceChild(newCount, document.getElementById('chosen_data'));
}

/**
 * activity when clicked change button
 * @param {table line} number 
 */
function clickChangeButton(number)
{
    if(document.getElementsByName('amount')[number].value == lastAmount_arr[number])
    {
        alert('수량이 변경되지 않았습니다.');
        return;
    }

    var product_list = document.getElementsByName('choose');
    var item_value = document.createElement('span');
    item_value.setAttribute('name', 'value_data');
    item_value.appendChild(document.createTextNode(getItemValue(number)));
    document.getElementsByName('item_value')[number].replaceChild(item_value, document.getElementsByName('value_data')[number]);
    
    product_list[number].checked = true;
    update_Choose_Product();
    
    lastAmount_arr[number] = document.getElementsByName('amount')[number].value;
}

/**
 * check and don't let input number datas are over the maximum range
 * @param {table line} number 
 */
function isUnderMax(number)
{
    var max_value = document.getElementsByName('amount')[number].getAttribute('max');
    var current_value = document.getElementsByName('amount')[number].value;
    if(Number(current_value) > Number(max_value))
    {
        document.getElementsByName('amount')[number].value = Number(max_value);
    }
}

/**
 * calculate 'number' line's price and amounts
 * @param {table line} number 
 */
function getItemValue(number)
{
    return document.getElementsByName('price')[number].textContent * document.getElementsByName('amount')[number].value;
}