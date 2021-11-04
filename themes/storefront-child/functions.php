<?php

add_filter('storefront_setting_default_values', 'override_default_button_color');
function override_default_button_color($fields)
{
    $fields['storefront_button_background_color'] = '#EC752D';
    $fields['storefront_accent_color'] = '#EC752D';
    return $fields;
}

add_action('wp_enqueue_scripts', 'custom_storefront_enqueue_styles');
function custom_storefront_enqueue_styles()
{
    wp_enqueue_style(
        'child-style',
        get_stylesheet_uri(),
        array( 'storefront-style' ),
        wp_get_theme()->get('Version')
    );
}

add_action('woocommerce_after_order_notes', 'favourite_spell_field');
function favourite_spell_field($checkout)
{
    echo '<div id="favourite_spell_field"><h2>' . __('Sort favori') . '</h2>';
    woocommerce_form_field('favourite_spell', array(
        'type'          => 'text',
        'class'         => array('form-row-wide'),
        'label'         => 'Entrer le nom de votre sort favori',
        'placeholder'   => 'Enchantement favori',
        ), $checkout->get_value('favourite_spell'));
    echo '</div>';
}
add_action('woocommerce_checkout_update_order_meta', 'save_favourite_spell_field');
function save_favourite_spell_field($order_id)
{
    if (!empty($_POST['favourite_spell'])) {
        update_post_meta($order_id, 'favourite_spell', sanitize_text_field($_POST['favourite_spell']));
    }
}

add_action('wp_ajax_get_ip', 'get_ip');
add_action('wp_ajax_nopriv_get_ip', 'get_ip');
function get_ip()
{
    $api_response = wp_remote_get('https://api.ipify.org');
    $api_response_body = wp_remote_retrieve_body($api_response);
    $return = array(
        'ip'  => $api_response_body
    );
    wp_send_json($return);
    wp_die();
}

add_action('wp_enqueue_scripts', 'custom_storefront_utils_enqueue_script');
function custom_storefront_utils_enqueue_script()
{
    wp_enqueue_script('custom_storefront_utils_scripts', get_stylesheet_directory_uri() . '/utils.js', false);
    wp_localize_script('custom_storefront_utils_scripts', 'custom_storefront_utils_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
      ));
}

add_action('woocommerce_after_single_product', 'print_ip_button');
function print_ip_button()
{
    echo '<div><button onclick="getIp()">Obtenir l&rsquo;adresse IP</button><p id="get_id_response"><p></div>';
}
