$(document).ready( function () {

} );

function displayMessage(response)
{
    if($('#uploader_div').css('display') != 'none')
        $('#uploader_div').hide('slow');
    var message = $('<div class="alert alert-error error-message" style="display: none;">');
    var close = $('<button type="button" class="close" data-dismiss="alert">&times</button>');
    message.append(close); // adding the close button to the message
    message.append(response);
    message.appendTo($('body')).fadeIn(300).delay(3000).fadeOut(1500);
}


function updateHistory()
{
    $.get("https://wt78.fei.stuba.sk/zadanie6/api/",
        function (data) {
            console.log(data);
        });
}
