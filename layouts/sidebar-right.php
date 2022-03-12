<?php
if ( !empty(gesus_theme_option('sidebar')) ) {
	echo '<div class="gesus-wedgets-area">';
	do_action('gesus_sidebar');
	echo '</div>';
} else {
	if ( is_active_sidebar('sidebar-1')){
		echo '<div class="gesus-wedgets-area">';
		dynamic_sidebar('sidebar-1');
		echo '</div>';
	}
}