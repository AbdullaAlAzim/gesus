<?php
if ( !empty(gesus_theme_option('sidebar')) ) {
    do_action('gesus_sidebar');
} else {
    if ( is_active_sidebar('sidebar-1')){
        echo '<div class="gesus-wedgets-area">';
        dynamic_sidebar('sidebar-1');
        echo '</div>';
    }
}