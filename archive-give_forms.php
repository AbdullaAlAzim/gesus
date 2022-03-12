<?php
/**
 *  Used to display an archive page of Give Donation forms.
 *
 *  This file is designed for use with the "default" twenty sixteen theme, and distributed as a sample
 *  Always test archive templates before using on production sites.
 *
 *  For more info, visit https://givewp.com
 *
 * @link https://givewp.com/
 * @author ben.meredith@gmail.com
 */

get_header();
?>
    <!-- Start Course
           ============================================= -->
    <section class="maan-course-area">
        <div class="container">
            <div class="row">
                <div class="maan-section-title text-center">
                    <h2><?php echo esc_html('FEATURED CAUSES');?></h2>
                    <p><?php echo esc_html('Appeals & Donations');?></p>
                </div>
            </div>
            <div class="course-wpr grid-3">
                <?php

                if (have_posts()) :
                    do_action('gesus-give-before-archive-loop');

                    while (have_posts()) : the_post();

                        do_action('gesus-give-before-archive-form');

                        get_template_part('template-parts/content', 'donation');

                        do_action('gesus-give-after-archive-form');
                    endwhile;

                else :
                    get_template_part('template-parts/content', 'none');
                endif;
                wp_reset_query();
                do_action('gesus-give-after-archive-loop');
                ?>
            </div>
        </div>
    </section>
<?php get_footer(); ?>