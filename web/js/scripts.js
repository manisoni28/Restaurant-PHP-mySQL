$(document).ready (function(){
    var hideMeFlag = $('#hide-flag').text();
    if (hideMeFlag == 'All') {
        $('#new-restaurant-form').hide();
    }
});
