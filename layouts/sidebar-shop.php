<?php
if ( !empty(gesus_theme_option('sidebar_shop')) ) {
	do_action('gesus_sidebar_shop');
} else {
	if ( is_active_sidebar('sidebar-shop')){
		echo '<div class="gesus-product-categories-side">';
		dynamic_sidebar('sidebar-shop');
		echo '</div>';
	}
}