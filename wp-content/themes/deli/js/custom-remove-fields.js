jQuery(document).ready(function($) {
    $('#clear_custom_fields_button').click(function(e) {
        e.preventDefault();

        $('#_custom_date').val('');
        $('#_custom_type').val('');
        $('#_custom_image').val('');
        
    });
});
