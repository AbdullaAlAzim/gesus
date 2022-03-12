<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
   <!--- blog section start -->
    <div class="gesus-blog-section gesus-section">
        <div class="container">
            <div class="gesus-blog-wraper">
                <div class="row">
                    <div class="<?php echo esc_attr($main); ?>">
                        <div class="gesus-card-area">
                            <div class="row">
                                 <?php if (have_posts()) :

                                /* Start the Loop */
                                while (have_posts()) : the_post();

                                    get_template_part('template-parts/content');

                                endwhile;

                            else :

                                get_template_part('template-parts/content', 'none');

                            endif; ?>
                          
                            </div>
                            <?php gesus_pagination(); ?>
                        </div>
                    </div>
                    <div class="<?php echo esc_attr($sidebar); ?>">
                          <?php get_sidebar(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--- blog section end -->

<?php get_footer(); ?>
