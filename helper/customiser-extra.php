<?php 

class gesus_theme_hooks {

    function __construct() {
         if (!class_exists('gesus_plugins_hooks')) {
                add_action('wp_body_open',array(&$this,'theme_render_preloader'));
                add_action('wp_body_open',array(&$this,'theme_render_scroll_top'));
        }
    }        
 
    function theme_render_preloader(){
            echo '<div class="preloader" data-background="'.get_template_directory_uri().'/assets/images/preloader.gif"></div>';
        
    }
    function theme_render_scroll_top(){
            echo '<button class="scroll-top">
                    <i class="far fa-angle-double-up"></i>
                </button>';
    }
}
new gesus_theme_hooks();