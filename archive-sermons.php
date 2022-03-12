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
?>
<!--- blog section start -->
    <section class="gesus-sermons-section gesus-section">
       <div class="container">
            <?php if ( have_posts()): while( have_posts()) : the_post(); 
                    get_template_part( 'template-parts/content', 'sermons' );
                endwhile; endif; ?>

                </div>
        </section>
    <section class="gesus-pagination-section gesus-section pt-0">
        <div class="container">
            <?php gesus_pagination();?>
        </div>
    </section>
              
<?php get_footer(); ?>