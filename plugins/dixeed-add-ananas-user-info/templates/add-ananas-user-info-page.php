<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package storefront
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
            <?php if (is_user_logged_in()) { ?>
                <h1><?php esc_html(the_title()); ?></h1>
                <form action='<?php echo esc_url(admin_url('admin-post.php')); ?>' method='POST'>
                    <input type='hidden' name='action' value='handle_ananas_form_submission'/>
                    <div>
                        <p>Aimez-vous l'ananas&nbsp;?</p>
                        <input type='radio' id='ananas-preference-yes' name='ananas-preference' value='yes'
                            <?php echo get_user_meta(get_current_user_id(), 'ananas_preference', true) ? "checked" : null ?>>
                        <label for='ananas-preference-yes'>Oui</label>
                        <input type='radio' id='ananas-preference-no' name='ananas-preference' value='no'
                        <?php echo get_user_meta(get_current_user_id(), 'ananas_preference', true) ? null : "checked" ?>>
                        <label for='ananas-preference-no'>Non</label>
                    </div>
                    <br/>
                    <div>
                        <label for='ananas-preference-reason'>Pourquoi aimez-vous l’ananas ou non&nbsp;?</label>
                        <textarea id='ananas-preference-reason' name='ananas-preference-reason'><?php
                            echo esc_html(get_user_meta(get_current_user_id(), 'ananas_preference_reason', true));
                        ?></textarea>
                    </div>
                    <input type='submit' name='submit' value='Valider'/>
                </form>
            <?php } else {
                $args = array(
                    'message' => '<h3 class="login-woo">Se connecter</h3>'
                );
                woocommerce_login_form($args);
            }
            ?>
		</main>
	</div>
<?php
do_action('storefront_sidebar');
get_footer();
