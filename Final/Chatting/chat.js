/**
 * Channel page에 message 추가
 */
function addMessage()
{
  let text = document.getElementById("messagetext").value;
  
  new Ajax.Updater('chatBox', 'add.php',
  {
    method: 'get',
    parameters:
    {
      data:text
    },
    
    onSuccess: function()
    {
      $('messagetext').value = '';
    }
  });
}

/**
 * Channel page에서 message 가져오기
 */
function getMessages()
{
  new Ajax.Updater('chatBox', 'messages.php', 
  {
    onSuccess: function() 
    { 
      window.setTimeout( getMessages, 1000 );
      return;
    }
  });
}

// getMessages();

/**
 * 중요한 목록 관리
 */
function controlImportant()
{
  let isImportant = jQuery("#toggle_important").attr("class");

  isImportant = controlButton(isImportant);

  jQuery.ajax({
    url:"changeImportant.php",
    type: 'get',
    data:
    {
      bool : isImportant  
    }
  });
}

function controlButton(number)
{
  if(number == 1)
  {
    jQuery("#toggle_important").attr("class", 0);
    jQuery("#toggle_important").attr("value", "Important");
    jQuery("#exit_chat").attr("disabled", false);
    return 0;
  }
  jQuery("#toggle_important").attr("class", 1);
  jQuery("#toggle_important").attr("value", "√ Important");
  jQuery("#exit_chat").attr("disabled", true);
  return 1;
}

/**
 * 채팅방에서의 탈퇴 기능
 */
function exitChannel()
{
  jQuery.ajax({
    url:"important.php",

    success:function(data)
    {
      data = JSON.parse(data)[0];

      if(data == 0)
      {
        removeChannelList();
        goMainPage();
      }
      else
      {
        alert("채널을 나갈 수 없습니다.");
        return;
      }
    }
  });

  return goMainPage();
}

function removeChannelList()
{
  jQuery.ajax({
    url:"removeChatting.php",
  });
}

/**
 * Main Page로 이동
 */
function goMainPage()
{
  return location.replace('./MainPage.html');
}

/**
 * 버튼 event 처리
 */
$("#add_chat").click(function()
{
  addMessage();
});

$("#return_page").click(function()
{
  goMainPage();
});

$('#exit_chat').click(function()
{
  exitChannel();
});

$('#toggle_important').click(function()
{
  controlImportant();
});

/**
 * initial 상태
 */
window.onload = function()
{
  jQuery.ajax({
    url:"important.php",

    success:function(data)
    {
      data = JSON.parse(data)[0];
      jQuery("#toggle_important").attr("class", data);

      if(data == 1) { controlButton(0) }
      else { controlButton(1) }
    }
  });

  this.getMessages();
}

/**
 * 엔터로 인한 잘못된 처리 방지
 */
document.addEventListener('keydown', function(event){
  if(event.keyCode === 13)
  {
    event.preventDefault();
  }
}, true);

