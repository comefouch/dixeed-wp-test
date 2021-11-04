<?php
/**
 * Plugin Name:       Dixeed Dashboard Message
 * Description:       Print a message on customers' dashboard
 * Version:           0.1.0
 * Author:            Côme de La Fouchardière
 */

function dashboard_message_register_settings()
{
    add_option('dashboard_message_content', 'Ce message apparaitra sur le dashboard des clients.');
    register_setting('dashboard_message_options_group', 'dashboard_message_content', 'dashboard_message_callback');
    add_option('dashboard_message_should_appear', false);
    register_setting('dashboard_message_options_group', 'dashboard_message_should_appear', 'dashboard_message_callback');
}
add_action('admin_init', 'dashboard_message_register_settings');

function dashboard_message_options_page()
{
    $message = esc_html(get_option('dashboard_message_content')); ?>
      <div>
      <h2>Message à transmettre au client par un message sur leur dashboard</h2>
      <form method="post" action="options.php">
      <?php settings_fields('dashboard_message_options_group'); ?>
      <table>
        <tr valign="center">
            <th scope="row"><label for="dashboard_message_should_appear">Faire apparaître le message</label></th>
            <td>
                <input type="checkbox" id="dashboard_message_should_appear" name="dashboard_message_should_appear" <?php echo get_option('dashboard_message_should_appear') ? "checked" : null ?>/>
                </td>
        </tr>
        <tr valign="center">
            <th scope="row"><label for="dashboard_message_content">Contenu du message</label></th>
            <td><textarea style="width:300px;" type="text" id="dashboard_message_content" name="dashboard_message_content"><?php echo $message; ?></textarea></td>
        </tr>
      </table>
      <?php submit_button(); ?>
      </form>
      </div>
    <?php
}

add_action('admin_menu', 'dashboard_message_register_menu_page');
function dashboard_message_register_menu_page()
{
    add_menu_page('Gestion du message à afficher sur le dashboard des clients', 'Dashboard Message', 'manage_options', 'dashboard_message', 'dashboard_message_options_page');
}

add_action('woocommerce_account_navigation', 'print_message_on_dashboard');
function print_message_on_dashboard()
{
    $message = esc_html(get_option('dashboard_message_content'));
    echo get_option('dashboard_message_should_appear') ? "<div class='notice'><em>$message</em></div><br/>" : null;
}
