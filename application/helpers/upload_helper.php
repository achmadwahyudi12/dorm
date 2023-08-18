<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Upload Helper
 */

if (!function_exists('do_image_upload')) {

    /**
     * Perform image upload with validation and security.
     *
     * @param string $field_name The name of the input field for the file upload.
     * @param string $upload_path The upload path where the image will be stored.
     * @param array $allowed_types An array of allowed image MIME types.
     * @param int $max_size Maximum allowed file size in kilobytes.
     * @return array|null Array containing 'success' (boolean) and 'error' (string) if upload failed.
     */
    function do_image_upload($input_name, $upload_path, $allowed_types, $max_size) {
        $CI = &get_instance();
        $CI->load->library('upload');
    
        $config['upload_path'] = $upload_path;
        $config['allowed_types'] = $allowed_types;
        $config['max_size'] = $max_size;
        $config['encrypt_name'] = TRUE;
    
        $CI->upload->initialize($config);
    
        if (!$CI->upload->do_upload($input_name)) {
            $error = $CI->upload->display_errors();
            return array('status' => false, 'error' => $error);
        } else {
            $upload_data = $CI->upload->data();
            return array('status' => true, 'upload_data' => $upload_data);
        }
    }
}
