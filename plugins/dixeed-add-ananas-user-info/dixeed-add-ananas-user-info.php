<?php
/**
 * Plugin Name:       Dixeed Add Ananas User Info Page
 * Description:       Adds a page that allows adding ananas info to the user
 * Version:           0.1.0
 * Author:            Côme de La Fouchardière
 */

function add_ananas_user_info_page()
{
    // wc_get_template(
    //     'add-ananas-user-info-page.php',
    //     array(
    //         'current_user' => get_user_by('id', get_current_user_id()),
    //     )
    // );
    $title = 'Informations sur les ananas';
    if (get_page_by_title($title) == null) {
        $add_user_info_page = array(
            'post_title'    => $title,
            'post_content'  => "",
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'page',
        );
        wp_insert_post($add_user_info_page);
    }
}

register_activation_hook(__FILE__, 'add_ananas_user_info_page');

add_filter('page_template', 'wpa3396_page_template');
function wpa3396_page_template($page_template)
{
    if (is_page('informations-sur-les-ananas')) {
        $page_template = dirname(__FILE__) . '/templates/add-ananas-user-info-page.php';
    }
    return $page_template;
}


add_action('admin_post_handle_ananas_form_submission', 'handle_ananas_form_submission');
function handle_ananas_form_submission()
{
    $user_id = get_current_user_id();
    $ananas_preference = ($_POST['ananas-preference'] == 'yes');
    $ananas_preference_reason = sanitize_text_field($_POST['ananas-preference-reason']);

    update_user_meta($user_id, 'ananas_preference_reason', $ananas_preference_reason);
    update_user_meta($user_id, 'ananas_preference', $ananas_preference);

    wp_redirect($_SERVER["HTTP_REFERER"], 302, 'WordPress');
    exit;
}
