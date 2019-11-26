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
 * Main Page로 이동
 */
function goMainPage()
{
  return;
}

