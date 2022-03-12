<?php
$id = get_the_ID();
// Output the content
$content_option = get_post_meta( $id, '_give_content_option', true );
if ( $content_option != 'none' ) {
    $content = get_post_meta( $id, '_give_form_content', true );
}
$checkout_label = get_post_meta($id, '_give_checkout_label', true);
$goal_progress = get_post_meta($id, '_give_form_goal_progress', true);
$goal_set = get_post_meta($id, '_give_set_goal', true);
$status = get_post_meta($id, '_give_form_status', true);
$meta = get_post_meta($id);
//var_dump($meta);
?>
<div class="course-box wow fadeInUp">
    <div class="course-pic">
        <a href="<?php the_permalink(); ?>">
            <?php give_get_template_part('single-give-form/featured-image'); ?>
        </a>
        <div class="course-pic-value">
            <span><?php echo wp_kses_post($status);?></span>
        </div>
        <div class="progressbar">
            <div class="progressbar-title">
                <div id="bar<?php echo esc_attr($id);?>" data-donate-id="<?php echo esc_attr($id);?>" class="barfiller">
                    <span class="tip"></span>
                    <span class="fill" data-percentage="<?php echo wp_kses_post($goal_progress);?>"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="course-info">
        <div class="course-meta">
            <h5><?php echo esc_html('By:');?> <?php echo get_the_author();?></h5>
            <ul>
                <li><a href="<?php echo esc_url('https://www.facebook.com/sharer/sharer.php?u='.get_the_permalink().'');?>"><i class="fab fa-facebook-f"></i></a></li>
                <li><a href="<?php echo esc_url('https://twitter.com/intent/tweet?url='.get_the_permalink().'&text='.get_the_title().'&via='.get_the_author_meta('twitter').'');?>"><i class="fab fa-twitter"></i></a></li>
                <li><a href="<?php echo esc_url('https://api.whatsapp.com/send?text='.get_the_title().': '.get_the_permalink().'');?>"><i class="fab fa-whatsapp"></i></a></li>

            </ul>
        </div>
        <div class="maan-course-content">
            <a href="<?php the_permalink(); ?>">
                <h4>
                    <?php the_title(); ?>
                </h4>
            </a>
            <p>
                <?php echo wp_kses_post(wp_trim_words($content, 15));?>
            </p>
        </div>
        <div class="maan-course-button">
            <a class="btn maan-btn-style-one" href="<?php the_permalink();?>"><?php echo wp_kses_post($checkout_label);?></a>
        </div>
    </div>
</div>
