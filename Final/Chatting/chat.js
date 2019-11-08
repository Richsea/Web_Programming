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


function getMessages()
{
  new Ajax.Updater( 'chat', 'messages.php', {
    onSuccess: function() { window.setTimeout( getMessages, 1000 ); }
  } );
}
getMessages();