<?php
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'gesus_register_required_plugins' );
function gesus_register_required_plugins() {

	$plugins = array(

		array(
			'name' => esc_attr__('Gesus Core','gesus'),
			'slug' => 'gesus-core',
			'source' => get_template_directory_uri() . '/plugin/gesus-core.zip',
			'required' => true,
			'version' => '1.0.0',
			'force_activation' => false,
			'force_deactivation' => false, 
		),
		array(
			'name' => esc_attr__('Contact Form 7','gesus'),
			'slug'=> 'contact-form-7', 
			'required' => true, 
			'force_activation'=> false,
			'force_deactivation' => false,
		),

        array(
			'name' => esc_attr__('Gesus Demo Importer','gesus'),
			'slug'=> 'one-click-demo-import',
			'required' => true,
			'force_activation'=> false,
			'force_deactivation' => false,
		),
    
		array(
			'name' => esc_attr__('Elementor','gesus'),
			'slug' => 'elementor', 
			'required' => true, 
			'version' => '', 
			'force_activation' => false, 
			'force_deactivation' => false,
			'external_url' => '',
		),
        array(
			'name' => esc_attr__('Give Wp','gesus'),
			'slug' => 'give',
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
        array(
			'name' => esc_attr__('WooCommerce','gesus'),
			'slug' => 'woocommerce',
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
        array(
			'name' => esc_attr__('Wishlist','gesus'),
			'slug' => 'yith-woocommerce-wishlist',
			'required' => true,
			'version' => '',
			'force_activation' => false,
			'force_deactivation' => false,
			'external_url' => '',
		),
     
	);

    $config = array(
        'default_path' => '',
        'menu' => 'tgmpa-install-plugins',
        'has_notices' => true, 
        'dismissable' => true,
        'dismiss_msg' => '',
        'is_automatic' => true,
        'message'=> '',
    );

    tgmpa( $plugins, $config );

}