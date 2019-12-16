$("#all_total div").click(function(event){
    let addList = $(event.target).attr("id");
    addDB(addList);
});

function addDB(chattingRoom)
{
    $.ajax({
        url: "./EnterNewRoom.php",
        type:"GET",
        data:
        {
            room_name : chattingRoom
        },

        success:function()
        {
            location.replace("./chat.php");
        }

    });
}
