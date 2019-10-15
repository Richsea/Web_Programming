/**
 * update all of the table line's checkboxes
 * update total cost and selected product's count
 */
function update_Choose_All()
{
    var product_list = document.getElementsByName('choose[]');
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
    var product_list = document.getElementsByName('choose[]');
    var checkCount = 0;     // for choosed product count
    var i = 0;

    var checkbox = makeupCheckboxList();

    while(true)
    {
        if(i > checkbox.length-1) break;

        if(checkbox[i])
            checkCount++;

        i++;
    }

    if(checkCount == product_list.length) document.getElementById("choose_all").checked = true;
    else document.getElementById("choose_all").checked = false;

    calculate_Value(checkbox);
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

    if(document.getElementById('choose_all').checked)
    {
        while(true)
        {
            if(i > document.getElementsByName('choose[]').length-1) break;

            newValue += getItemValue(i);
            i++;
        }
    }
    else
    {
        if(array)
        {
            while(true)
            {
                if(i > document.getElementsByName('choose[]').length-1) break;
                
                if(array[i])
                    newValue += getItemValue(i);
                i++;
            }
        }
    }

    var newTotal = document.createElement('span');
    newTotal.setAttribute('id', 'cost_data');
    newTotal.appendChild(document.createTextNode(newValue));
    document.getElementById('total_cost').replaceChild(newTotal, document.getElementById('cost_data'));
}

/**
 * update checkbox checked count
 * @param {product chosen} number 
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
    var elementAmount = document.getElementsByName('amount[]')[number];

    if(elementAmount.value == elementAmount.getAttribute('class'))
    {
        alert('수량이 변경되지 않았습니다.');
        return;
    }

    var product_list = document.getElementsByName('choose[]');
    var item_value = document.createElement('span');
    item_value.setAttribute('name', 'value_data');
    item_value.appendChild(document.createTextNode(getItemValue(number)));
    document.getElementsByName('item_value')[number].replaceChild(item_value, document.getElementsByName('value_data')[number]);
    
    elementAmount.setAttribute('class', elementAmount.value);
    
    product_list[number].checked = true;
    update_Choose_Product();    
}

/**
 * activity when clicked remove button
 */
function clickRemoveButton()
{
    var checkedBoxList = makeupCheckboxList();
    var line = document.getElementsByName('table_line');
    var i = checkedBoxList.length-1;

    while(true)
    {
        if(i < 0) break;

        if(checkedBoxList[i])
        {
            line[i].parentNode.removeChild(line[i]);
        }
        i--;
    }
    // 여기에 global 변수와 array위치 갱신할 필요 존재
    calculate_Value();
    setChosenProduct(0);
}

/**
 * activity when clicked order button
 */
function clickOrderButton()
{
    var checkedBoxList = makeupCheckboxList();
    var buyer_id = document.getElementById("buyer_id").value;
    var textType = /[0-9a-zA-Z]/;
    var isChecked = false;
    var isEngId = false;
    var i = 0;

    while(true)
    {
        if(i > checkedBoxList.length -1) break;

        if(checkedBoxList[i])
            isChecked = true;

        i++;
    }
    
    i = 0;
    while(true)
    {
        if(i > buyer_id.length - 1) break;

        if(textType.test(buyer_id.charAt(i)))
            isEngId = true;
        else
        {
            isEngId = false;
            break;
        }
        console.log(buyer_id.charAt(i));
        i++;
    }

    var order = document.getElementById('order_work');
    order.setAttribute('value', 'false');

    // both checkbox and input type check
    if(!isChecked && !isEngId)
    {
        alert("아이디는 영문자로 입력하시고, 체크 박스도 선택해주세요.");
        return;
    }

    // checkbox clicked check
    if(!isChecked)
    {
        alert("체크 박스를 선택해주세요.");
        return;
    }
    
    // id input type english check
    if(!isEngId)
    {
        alert("아이디는 영문자로 입력해주세요.");
        return;
    }

    // all check is clear
    order.setAttribute('value', 'true');
}

/**
 * make checkbox list
 */
function makeupCheckboxList()
{
    var product_list = document.getElementsByName('choose[]');
    var array_chosen = new Array(product_list.length);
    var i = 0;

    while(true)
    {
        if(i > array_chosen.length - 1) break;

        if(product_list[i].checked)
            array_chosen[i] = true;
        else 
            array_chosen[i] = false;

        i++;
    }

    return array_chosen;
}

/**
 * check and don't let input number datas are over the maximum range
 * @param {table line} number 
 */
function isUnderMax(number)
{
    var max_value = document.getElementsByName('amount[]')[number].getAttribute('max');
    var current_value = document.getElementsByName('amount[]')[number].value;
    if(Number(current_value) > Number(max_value))
    {
        document.getElementsByName('amount[]')[number].value = Number(max_value);
    }
}

/**
 * calculate 'number' line's price and amounts
 * @param {table line} number 
 */
function getItemValue(number)
{
    return document.getElementsByName('price')[number].textContent * document.getElementsByName('amount[]')[number].value;
}


/**
 * check submit is ok
 */
function submitCheck()
{
    if(document.getElementById('order_work').value == 'true')
        return true;
    return false;
}