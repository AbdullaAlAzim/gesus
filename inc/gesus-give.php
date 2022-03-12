<?php
final class gesus_give_hooks{
    function __construct(){
        add_action('give_sidebar', [$this, 'donation_single_sidebar']);
        add_action('give_before_template_part', [$this, 'donation_single_div']);
        add_action('give_after_template_part', [$this, 'donation_single_percentage']);
    }
    public function donation_single_sidebar(){
        $give_sidebar_switch = gesus_theme_option('give_sidebar_switch');
        $give_sidebar = gesus_theme_option('give_sidebar');
        if ($give_sidebar_switch == '1'){
            echo do_shortcode('[INSERT_ELEMENTOR id="' . $give_sidebar . '"]');
        }else{
            give_get_forms_sidebar();
        }
    }
    public function donation_single_div(){
        ?>
            <div class="gesus-progressbar">
        <?php
    }
    public function donation_single_percentage(){
        $id = get_the_ID();
        $goal_progress = get_post_meta($id, '_give_form_goal_progress', true);
        ?>
            <div class="ab-progress" data-progress data-tooltip="true" data-value="<?php echo wp_kses_post($goal_progress); ?>"></div>
        </div>
        <?php
    }
}
new gesus_give_hooks();