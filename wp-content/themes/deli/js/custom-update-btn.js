jQuery(document).ready(function($) {
    $('#js_submit_button').click(function(e) {
        e.preventDefault();
        $('form#post').submit(); 
    });
});
