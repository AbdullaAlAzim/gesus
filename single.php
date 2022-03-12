<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 */
get_header();
if ( is_active_sidebar( 'sidebar-1' ) || !empty(gesus_theme_option('sidebar')) ) {
    $main = 'col-lg-8';
    $sidebar = 'col-lg-4';
} else {
    $main = 'col-lg-12';
    $sidebar = 'col-lg-12';
}
?>
    <div class="gesus-blog-section gesus-section">
        <div class="container">
            <div class="gesus-blog-wraper">
                <div class="row">
                    <div class="<?php echo esc_attr($main); ?>">
                        <?php
                        while ( have_posts() ) :
                            the_post();

                             get_template_part('template-parts/singlecontent');
                        

                            // If comments are open or we have at least one comment, load up the comment template.
                            if ( comments_open() || get_comments_number() ) :
                                comments_template();
                            endif;

                        endwhile; // End of the loop.
                        ?>
                        </div>
                        <div class="<?php echo esc_attr($sidebar); ?>">
                            <?php get_template_part('layouts/sidebar', 'right'); ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
<?php get_footer();