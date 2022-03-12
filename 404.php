<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 */

get_header();
?>
  <!--  error section start  -->
    <section class="gesus-error-section gesus-section">
        <div class="container">
            <div class="error-wrapper">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/error/404.png" alt="">
                <h2><?php echo esc_html__('Oops... It looks like you ‘re lost !','gesus'); ?></h2>
                <p><?php echo esc_html__('Oops! The page you are looking for does not exist. It might have been moved or deleted.','gesus'); ?></p>
                <a href="<?php echo esc_url(home_url()); ?>" class="btn gesus-btn gesus-black-btn"><?php echo esc_html__('back to home','gesus'); ?></a>
            </div>
        </div>
    </section>
    <!--  error  section end  -->

<?php
get_footer();
?>
