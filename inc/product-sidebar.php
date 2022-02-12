<?php
// WooCommerce
$product = wc_get_product( get_the_ID() );
$rating_count = $product->get_rating_count();
$average = $product->get_average_rating();
$product_download_tag = get_post_meta( get_the_ID(), 'product_download_tag' );
$unique_features = get_post_meta( get_the_ID(), 'unique_features', 1 );
$digicart_features_group = get_post_meta( get_the_ID(), 'digicart_features_group', true );

// Exclude sale count.
$dgc_exclude_sale_ids = get_theme_mod('exclude_product_sale_count') ? explode(',', get_theme_mod('exclude_product_sale_count')) : [];
$exclude_sale_count = in_array($product->get_id(), $dgc_exclude_sale_ids) !== false ? 0 : 1;



?>
<?php if ( ! empty( $product_download_tag ) && $product_download_tag[0] == 'free' ) : ?>

    <?php do_action( 'digicart_product_download_link' ); ?>

<?php endif ?>
<div class="digicart-widget-woocommerce">
    <div class="widget-product-details">
        <div class="widget-price">
            <?php woocommerce_template_single_price(); ?>
        </div>
        <div class="widget-rating">
            <?php echo wc_get_rating_html( $average, $rating_count ); ?>
        </div>
        <?php if ( $unique_features ) : ?>
            <ul class="float-start text-left list-unstyled mb-4">
                <?php foreach ( $unique_features as $key => $unique_feature ) : ?>
                    <li><i class="fa fa-check-circle text-success fa-fw"></i> <?php echo esc_html( $unique_feature ); ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>

        <div class="widget-add-to-cart">
            <?php woocommerce_template_single_add_to_cart(); ?>
        </div>

    </div>
</div>

<div class="digicart-widget-woocommerce">
    <div class="widget-product-details">
        <ul class="list-inline text-left product-sidebar-stats">
            <?php if ( 1 == $exclude_sale_count ) {?>
                <li>
                    <i class="fa fa-shopping-cart"></i>
                    <span><?php echo get_post_meta( get_the_ID(), 'total_sales', true ); ?> <?php echo esc_html__( 'Sales', 'digicart' ); ?></span>
                </li>
            <?php } ?>
            <li>
                <i class="fa fa-star"></i>
                <span><?php echo esc_html( $rating_count ); ?> <?php echo esc_html__( 'Ratings', 'digicart' ); ?></span>
            </li>
            <?php if ( function_exists( 'getPostViews' ) ) { ?>
                <li>
                    <i class="fa fa-eye"></i>
                    <span><?php echo getPostViews( get_the_id() ); ?> <?php echo esc_html__( 'Views', 'digicart' ); ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>

<?php
if ( class_exists('WeDevs_Dokan') ) {
// Get the author ID (the vendor ID)
    $vendor_id = get_post_field( 'post_author', get_the_id() );
// Get the WP_User object (the vendor) from author ID
    $vendor = new WP_User($vendor_id);
    $store_info  = dokan_get_store_info( $vendor_id ); // Get the store data
    $store_name  = $store_info['store_name'] != '' ? $store_info['store_name'] : $vendor->display_name; // Get the store name
    $store_url   = dokan_get_store_url( $vendor_id );  // Get the store URL

    ?>

    <!--Profile Card-->
    <div class="dgc-author-profile">
        <div class="cover-photo"></div>
        <div class="photo">
            <?php echo get_avatar( $vendor_id, null );?>
        </div>
        <div class="content">
            <h2>@<?php echo esc_html($store_name);?></h2>
            <a href="<?php echo esc_url_raw($store_url);?>"><?php esc_html_e('View author profile', 'digicart');?></a>
        </div>
    </div>

<?php } ?>

<div class="digicart-widget-woocommerce">
    <h4 class="digicart-widget-woocommerce-title"><?php echo esc_html__( 'Specification', 'digicart' ); ?></h4>
    <div class="widget-product-details">
        <table>
            <tbody>
            <tr>
                <th><?php echo esc_html__( 'Last Update:', 'digicart' ); ?></th>
                <td><span><?php the_modified_date(); ?></span></td>
            </tr>
            <tr>
                <th><?php echo esc_html__( 'Released:', 'digicart' ); ?></th>
                <td><span><?php echo get_the_date(); ?></span></td>
            </tr>

            <?php
            $attributes = $product->get_attributes();
            foreach ( $attributes as $product_attribute_key => $product_attribute ) { ?>
                <tr>
                    <th><?php echo wc_attribute_label( $product_attribute['name'] ); ?></th>
                    <td>
                        <span><?php echo esc_html( $product_attribute['value'] ); ?></span>
                    </td>
                </tr>

                <?php
            }

            $product_tags = get_the_terms( get_the_ID(), 'product_tag' ); ?>
            <tr>
                <th><?php echo esc_html__( 'Tags:', 'digicart' ); ?></th>
                <td>
					<span>
					<?php
                    if ( $product_tags ) {
                        echo wc_get_product_tag_list( $product->get_id(), ', ' ); // phpcs:ignore
                    } else {
                        echo esc_html__( 'No Tags Found!', 'digicart' );
                    }
                    ?>
					</span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
