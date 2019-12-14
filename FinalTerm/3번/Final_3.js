let timer;

window.onload = function()
{
}

function timerAction()
{
    let time = Number($("#timer").html());
    if(Number(time) >= 150)
    {
        clearInterval(timer);
    }
    else
    {
        $("#timer").html(time+1);
    }
}

$("#start").click(function()
{
    $("#register").attr("disabled", false);
    $("#start").attr("disabled", true);
    $("#timer").html(1);
    timer = window.setInterval(timerAction, 1000)
});

$("#register").click(function()
{
    $(".form_box").css("display", "block");
});

$("#cancel_button").click(function()
{
    $(".form_box").css("display", "none");
    $("#name").val("");
    $("#file").val("");
});

$("#submit_button").click(function()
{
    let img = $("#file").val();
    let img_name = $("#name").val();

    $(".form_box").css("display", "none");
    $("#name").val("");
    $("#file").val("");

    let newDiv = $('<div><div><img src=' + img + 'alt=""></div><div>' + img_name + '</div></div>');
    $("#selectedItem").append(newDiv);
});

$("#selectedItem").change()
{
    $("#create_cart").attr("disabled", false);
    
}

$("#create_cart").click(function()
{
    prompt("Please enter cart name:", "");
});