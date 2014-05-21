$(document).ready (function() {
   
    // ukrywanie message-a po kliknięciu
    $('#flash_messages ul').click(function(e) {
        $(e.target).parent('ul').remove();
    });

});