/**
 * Channel page에 message 추가
 */
function addmessage()
{
  new Ajax.Updater( 'chat', 'add.php',
  {
     method: 'post',
     parameters: $('chatmessage').serialize(),
     onSuccess: function() {
       $('messagetext').value = '';
     }
  } );
}

/**
 * Channel page에서 message 가져오기
 */
function getMessages()
{
  new Ajax.Updater( 'chat', 'messages.php', {
    onSuccess: function() { window.setTimeout( getMessages, 1000 ); }
  } );
}
getMessages();

/**
 * 중요한 목록 관리
 */
function controlImportant()
{

}

/**
 * 채팅방에서의 탈퇴 기능
 */
function exitChannel()
{
  /*
  if(채팅방의 마지막인원) 채널 삭제
  else 자기 자신만 채팅방에서 탈퇴
  */
}

/**
 * Main Page로 이동
 */
function goMainPage()
{
  return;
}

