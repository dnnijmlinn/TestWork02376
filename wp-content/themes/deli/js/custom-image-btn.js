jQuery(document).ready(function($) {
    var mediaUploader;

    var savedImage = localStorage.getItem('unsavedImage');
    if (savedImage) {
        $('#_custom_image').val(savedImage);
        $('#_custom_image_display').attr('src', savedImage).show();
        $('#remove_custom_image_button').show();
        $('#upload_custom_image_button').hide();
    }

    $('#upload_custom_image_button').click(function(e) {
        e.preventDefault();

        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        mediaUploader = wp.media.frames.file_frame = wp.media({
            title: 'Select image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        });

        mediaUploader.on('select', function() {
            var attachment = mediaUploader.state().get('selection').first().toJSON();
            $('#_custom_image').val(attachment.url);
            $('#_custom_image_display').attr('src', attachment.url).show();
            $('#remove_custom_image_button').show();
            $('#upload_custom_image_button').hide();

            localStorage.setItem('unsavedImage', attachment.url);
        });

        mediaUploader.open();
    });

    $('#remove_custom_image_button').click(function(e) {
        e.preventDefault();
        $('#_custom_image').val('');
        $('#_custom_image_display').attr('src', '').hide();
        $(this).hide();
        $('#upload_custom_image_button').show();

        localStorage.removeItem('unsavedImage');
    });

    // Функция для очистки всех полей
    $('#clear_custom_fields_button').click(function(e) {
        e.preventDefault();
        $('#_custom_date').val(''); 
        $('#_custom_type').val(''); 
        $('#_custom_image').val(''); 
        $('#_custom_image_display').attr('src', '').hide();
        $('#remove_custom_image_button').hide();
        $('#upload_custom_image_button').show();
        localStorage.removeItem('unsavedImage');
    });

    $('#js_submit_button').click(function(e) {
        e.preventDefault();
        $('form').submit(); 

        localStorage.removeItem('unsavedImage');
    });
});
