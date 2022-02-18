<?php


/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package digicart
 */

/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)-in-3.0.0
 *
 * @return void
 */
function dostart_woocommerce_setup() {
	
        /**
         * Woocommerce Support.
         * Product Gallery | Product Lightbox | Product Slider
         */
        add_theme_support('woocommerce'); 
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        
}
add_action( 'after_setup_theme', 'dostart_woocommerce_setup' );


/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function dostart_woocommerce_scripts() {

	wp_enqueue_style( 'dostart-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce.min.css' );

	$font_path   = WC()->plugin_url() . '/assets/fonts/';
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

	wp_add_inline_style( 'dostart-woocommerce-style', $inline_font );
}
add_action( 'wp_enqueue_scripts', 'dostart_woocommerce_scripts' );



if ( ! function_exists('dostart_cart_link') ) {

    function dostart_cart_link() {
        ?>    
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'dostart'); ?>">
            <i class="fa fa-shopping-bag"><span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span></i>
            <!-- <div class="amount-cart"><?php// echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></div>  -->
        </a>
        <?php
    }
}

if ( ! function_exists('dostart_header_cart') ) {

    function dostart_header_cart() {
        ?>
            <div class="header-cart">
                <div class="header-cart-block">
                    <div class="header-cart-inner">
                        <?php dostart_cart_link(); ?>
                       <!--  <ul class="site-header-cart menu list-unstyled text-center">
                            <li>
                               // the_widget('WC_Widget_Cart', 'title='); ?>
                            </li>
                        </ul> -->
                    </div>
                </div>
            </div>
    <?php }
}

if ( ! function_exists('dostart_header_add_to_cart_fragment') ) {
    add_filter('woocommerce_add_to_cart_fragments', 'dostart_header_add_to_cart_fragment');

    function dostart_header_add_to_cart_fragment( $fragments ) {
        ob_start();

        dostart_cart_link();

        $fragments['a.cart-contents'] = ob_get_clean();

        return $fragments;
    }
}
