<?php
/**
 * The Template for displaying all single Give Forms.
 *
 * Override this template by copying it to yourtheme/give/single-give-forms.php
 *
 * @package       Give/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header();
?>
<!-- FEATUREd CAUSES section start  -->
<section class="gesus-featured-causes-section gesus-section">
    <div class="container">
        <div class="gesus-featured-causes-wrapper">
            <div class="row">
                <div class="col-lg-8">
                    <?php
                    /**
                     * Fires in single form template, before the main content.
                     *
                     * Allows you to add elements before the main content.
                     *
                     * @since 1.0
                     */
                    do_action( 'give_before_main_content' );

                    while ( have_posts() ) :
                        the_post();

                        give_get_template_part( 'single-give-form/content', 'single-give-form' );

                    endwhile; // end of the loop.

                    /**
                     * Fires in single form template, after the main content.
                     *
                     * Allows you to add elements after the main content.
                     *
                     * @since 1.0
                     */
                    do_action( 'give_after_main_content' );
                    ?>
                </div>
                <div class="col-lg-4">
                    <?php
                    /**
                     * Fires in single form template, on the sidebar.
                     *
                     * Allows you to add elements to the sidebar.
                     *
                     * @since 1.0
                     */
                    do_action( 'give_sidebar' );
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- FEATUREd CAUSES section end  -->
<?php
get_footer();
