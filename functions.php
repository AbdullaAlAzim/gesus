<?php
/**
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */
define('GESUS_PATH', get_template_directory());
if (!function_exists('gesus_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function gesus_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on _s, use a find and replace
         * to change 'gesus' to the name of your theme in all the template files.
         */
        load_theme_textdomain('gesus', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');
        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo');
        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'gesus'),
        ));
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');
        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'script',
            'style'
        ));
        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('gesus_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
        remove_theme_support( 'widgets-block-editor' );
    }
endif;
add_action('after_setup_theme', 'gesus_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function gesus_content_width()
{
    $GLOBALS['content_width'] = apply_filters('gesus_content_width', 640);
}

add_action('after_setup_theme', 'gesus_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function gesus_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'gesus'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'gesus'),
        'before_widget' => '<div id="%1$s" class="gesus-wedgets widget widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="wedgets-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Sidebar Shop', 'gesus'),
        'id' => 'sidebar-shop',
        'description' => esc_html__('Add widgets here.', 'gesus'),
        'before_widget' => '<div id="%1$s" class="widgets %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="gesus-widgets-title">',
        'after_title' => '</h2>',
    ));
    register_sidebar(array(
        'name' => esc_html__('Footer Widget', 'gesus'),
        'id' => 'footer-widget',
        'description' => esc_html__('Add widgets here.', 'gesus'),
        'before_widget' => '<div class="col-lg-4"><div id="%1$s" class="footer-items %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h2 class="footer-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'gesus_widgets_init');

function gesus_fonts_url()
{
    $fonts_url = '';
    $fonts = array();
    $subsets = '';

    if ('off' !== esc_html_x('on', 'Roboto font: on or off', 'gesus')) {
        $fonts[] = 'Roboto:300,400,500,700,900';
    }
    if ('off' !== esc_html_x('on', 'Yeseva One: on or off', 'gesus')) {
        $fonts[] = 'Yeseva One';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
        ), 'https://fonts.googleapis.com/css');
    }

    return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function gesus_scripts()
{
  //css file integrate
    wp_enqueue_style('gesus-fonts', gesus_fonts_url());

    wp_register_style('gesus-bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.min.css');
    wp_enqueue_style('gesus-bootstrap');

    wp_register_style('gesus-fontawesome', get_template_directory_uri() . '/assets/fonts/fontawesome/css/fontawesome-all.min.css');
    wp_enqueue_style('gesus-fontawesome');

    wp_register_style('gesus-theme-main', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    wp_enqueue_style('gesus-theme-main');

    wp_register_style('gesus-nice-csss', get_template_directory_uri() . '/assets/css/nice-select.css');
    wp_enqueue_style('gesus-nice-csss');

    wp_register_style('gesus-plrcss', get_template_directory_uri() . '/"assets/css/plyr.css');
    wp_enqueue_style('gesus-plrcss');

    wp_register_style('gesus-main', get_template_directory_uri() . '/assets/css/style.css');
    wp_enqueue_style('gesus-main');

    wp_register_style('gesus-donation', get_template_directory_uri() . '/assets/css/donation.css');    
    wp_enqueue_style('gesus-donation');

    wp_enqueue_style('gesus-default', get_template_directory_uri() . '/assets/css/default.css');
    

    wp_register_style('gesus-newcss', get_template_directory_uri() . '/assets/css/new.css');
    wp_enqueue_style('gesus-newcss');

    wp_register_style('gesus-woo-default', get_template_directory_uri() . '/assets/css/woo-default-wie.css');
    wp_enqueue_style('gesus-woo-default');

    wp_register_style('gesus-style', get_stylesheet_uri());
    wp_enqueue_style('gesus-style');

    wp_dequeue_style('give-styles');
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    //js file integrate
    wp_register_script('gesus-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-bootstrap');

    wp_register_script('gesus-numberr', get_template_directory_uri() . '/assets/js/jquery.nice-number.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-numberr');

    wp_register_script('gesus-selectt', get_template_directory_uri() . '/assets/js/jquery.nice-select.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-selectt');


    wp_register_script('gesus-barfiller', get_template_directory_uri() . '/assets/js/barfiller.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-barfiller');

     wp_register_script('gesus-plyrjs', get_template_directory_uri() . '/assets/js/plyr.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-plyrjs');

    wp_register_script('gesus-script', get_template_directory_uri() . '/assets/js/theme.js', array('jquery'), gesus_theme_version(), true);
    wp_enqueue_script('gesus-script');

    wp_enqueue_style('dashicons');
}

add_action('wp_enqueue_scripts', 'gesus_scripts', 99);
function gesus_admin_css()
{
    wp_enqueue_style('admin-style', get_template_directory_uri() . '/assets/css/admin.css');
}

add_action('admin_enqueue_scripts', 'gesus_admin_css');

function gesus_theme_version()
{
    $gesustheme = wp_get_theme();
    $gesus_version = esc_html($gesustheme->get('Version'));
    return $gesus_version;
}

/**
 * Load WooCommerce compatibility file.
 */
if (class_exists('WooCommerce')) {
    require_once GESUS_PATH . '/inc/woocommerce.php';
}

/**
 * Custom template tags for this theme.
 */
require_once GESUS_PATH . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once GESUS_PATH . '/inc/template-functions.php';
/**
 * Functions which loaded from plugin.
 */
require_once GESUS_PATH . '/inc/plug-dependent.php';
require_once GESUS_PATH . '/helper/customiser-extra.php';
require_once GESUS_PATH . '/inc/gesus-give.php';
/**
 * Load plugin recommendation.
 */
require_once GESUS_PATH . '/inc/plugin-recommendations.php';
function risset($array, $default = false)
{
    if (isset($array)) {
        return $array;
    }
    return $default;
}

/*for commnets tempples*/
require_once GESUS_PATH . '/inc/comment-template.php';
function circlecube_comment_form($args)
{
    $args['gesus-btn gesus-post-btn'] = 'button';

    return $args;

}
add_filter('comment_form_defaults', 'circlecube_comment_form');

function custom_submit_comment_form($submit_button)
{
    return '<button class="gesus-btn gesus-post-btn">post comment</button>';
}

add_filter('comment_form_submit_button', 'custom_submit_comment_form');

/**
 * Moving the comments text field to bottom
 *
 */
function plus_point_move_comment($fields)
{
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'plus_point_move_comment');
//* Remove comment before and after notes
add_filter('comment_form_defaults', 'afn_custom_comment_form');
function afn_custom_comment_form($fields)
{
    $fields['comment_notes_before'] = '';
    $fields['comment_notes_after'] = '';
    return $fields;
}
// custom image size
add_image_size('plus-point-310-300', 310, 300, true);
add_image_size('plus-point-80-75', 80, 75, true);
add_image_size('plus-point-72-65', 72, 65, true);
add_image_size('plus-point-80-75', 80, 75, true);
add_image_size('plus-point-543-478', 543, 478, true);

add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query)
{
    if (is_category()) {
        $post_type = get_query_var('post_type');
        if ($post_type)
            $post_type = $post_type;
        else
            $post_type = array('nav_menu_item', 'post', 'sermons');
        $query->set('post_type', $post_type);
        return $query;
    }
}

//woocommerce shop page title change
add_filter( 'woocommerce_page_title', 'new_woocommerce_page_title');
function new_woocommerce_page_title( $page_title ) {
  if( $page_title == 'Shop' ) {
    return "Christians Goods Shop";
  }
}