<?php

 add_action( 'woocommerce_product_options_general_product_data', 'custom_fields_add');
 function custom_fields_add() {
    global $post;
    $customImage = get_post_meta($post->ID, '_custom_image', true);
    $customDate = get_post_meta($post->ID, '_custom_date', true);
    $customType = get_post_meta($post->ID, '_custom_type', true);

    woocommerce_wp_text_input( array(
        'id' => '_custom_date',
        'label' => __( 'Date of creation', 'woocommerce' ),
        'desc_tip' => 'true',
        'type' => 'date',
        'value' => $customDate
    ) );

    woocommerce_wp_select( array(
        'id' => '_custom_type',
        'label' => __( 'Type of product', 'woocommerce' ),
        'options' => array(
            '' => 'Select product type', 
            'rare' => 'Rare',
            'frequent' => 'Frequent',
            'unusual' => 'Unusual'
        ),
        'value' => $customType 
    ) );
    
        echo '<div class="options_group">';
        echo '<p class="form-field custom_field_type">
            <label for="custom_field_type">Picture</label>';
        if ($customImage) {
            echo '<img src="' . esc_url($customImage) . '" style="max-width:100px; display:block;" id="_custom_image_display">';
        } else {
            echo '<img src="" style="max-width:100px; display:none;" id="_custom_image_display">';
        }
        echo '<input type="hidden" name="_custom_image" id="_custom_image" value="' . esc_attr($customImage) . '">';
        echo '<button type="button" class="button custom-upload-button" id="upload_custom_image_button">Upload image</button>';
        if ($customImage) {
            echo '<button type="button" class="button" id="remove_custom_image_button">Delete image</button>';
        } else {
            echo '<button type="button" class="button custom-button" style="display:none;" id="remove_custom_image_button">Delete image</button>';
        }
        echo '</p>';
        echo '</div>';
        echo '<div class="custom-buttons-container form-field  ">';
        echo '<button type="button" class="button custom-button clear-button form-field" id="clear_custom_fields_button">Clear fields</button>';
        echo '<button type="button" class="button custom-button update-button form-field" id="js_submit_button">Update product</button>';
        echo '</div>'; 

        }

add_action( 'woocommerce_process_product_meta', 'custom_fields_save' );
function custom_fields_save( $post_id ) {
    if ( !empty( $_POST['_custom_date'] ) ) {
        update_post_meta( $post_id, '_custom_date', esc_attr( $_POST['_custom_date'] ) );
    } else {
        delete_post_meta($post_id, '_custom_date');
    }

    if ( !empty( $_POST['_custom_type'] ) ) {
        update_post_meta( $post_id, '_custom_type', esc_attr( $_POST['_custom_type'] ) );
    } else {
        delete_post_meta($post_id, '_custom_type');
    }

    if ( isset($_POST['_custom_image']) && $_POST['_custom_image'] != '' ) {
        update_post_meta( $post_id, '_custom_image', esc_attr( $_POST['_custom_image'] ) );
    
        $attachment_id = attachment_url_to_postid( esc_attr( $_POST['_custom_image'] ) );
    
        if ( $attachment_id ) {
            set_post_thumbnail( $post_id, $attachment_id );
        } else {
            error_log( 'Attachment ID not found for URL: ' . esc_attr( $_POST['_custom_image'] ) );
        }
    } else {
        delete_post_meta($post_id, '_custom_image');
        delete_post_thumbnail( $post_id );
    }
    }
