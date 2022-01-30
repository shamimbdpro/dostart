<?php

/**
 * Class Dostart_Meta
 */
class Dostart_Meta
{

    private static $instance = null;
    public static function get_instance()
    {
        if (!self::$instance)
            self::$instance = new self();
        return self::$instance;
    }

    /**
     * Initialize global hooks.
     */
    public function init()
    {

        add_action('add_meta_boxes', function () {
            $screens = array('post', 'page');

            foreach ($screens as $screen) {
                add_meta_box("dostart_settings_meta_box", "Dostart Settings", array($this, 'dostart_meta_box_callback'), $screen, "side", "high");
            }
        });


        /* Save post meta on the 'save_post' hook. */
        add_action('save_post', [$this, 'save_dostat_meta_box_data']);
    }


    /**
     * Meta box display.
     *
     * @access public
     * 
     * @return void
     */
    public function dostart_meta_box_callback()
    {
        wp_nonce_field( basename( __FILE__ ), 'dostart_settings_meta_box_nonce' );

        $header_meta = get_post_meta(get_the_ID(), 'dostart-header-status', true); ?>

        <h3>Disable Section</h3>

        <div class="dostart-meta-status">
            <label for="dostart-header-status">
                <input type="checkbox" id="dosart-header-status" name="dostart-header-status" value="disabled" <?php checked($header_meta, 'disabled'); ?> />
                <?php esc_html_e('Disable Header', 'dostart'); ?>
            </label>
        </div>

       <?php  $dostart_breadcrumb_meta = get_post_meta(get_the_ID(), 'dostart-breadcrumb-status', true); ?>

        <div class="dostart-meta-status">
            <label for="dostart-breadcrumbs-content">
                <input type="checkbox" id="dosart-breadcrumb-status" name="dostart-breadcrumb-status" value="disabled" <?php  checked($dostart_breadcrumb_meta, 'disabled'); ?> />
                <?php  esc_html_e('Disable Breadcrumb', 'dostart'); ?>
            </label>
        </div>


       <?php $dostart_widget_meta = get_post_meta(get_the_ID(), 'dostart-widget-status', true); ?>

        <div class="dostart-meta-status">
            <label for="dostart-widget-content">
                <input type="checkbox" id="dosart-widget-status" name="dostart-widget-status" value="disabled" <?php checked($dostart_widget_meta, 'disabled'); ?> />
                <?php esc_html_e('Disable Widget', 'dostart'); ?>
            </label>
        </div>

        
       <?php $dostart_footer_meta = get_post_meta(get_the_ID(), 'dostart-footer-status', true); ?>

        <div class="dostart-meta-status">
            <label for="dostart-footer-content">
                <input type="checkbox" id="dosart-footer-status" name="dostart-footer-status" value="disabled" <?php checked($dostart_footer_meta, 'disabled'); ?> />
                <?php esc_html_e('Disable Footer', 'dostart'); ?>
            </label>
        </div>

<?php }


    /**
     * Metabox Save
     *
     * @param  number $post_id Post ID.
     * @return void
     */
    public function save_dostat_meta_box_data($post_id)
    {

       		// Checks save status.
			$is_autosave = wp_is_post_autosave( $post_id );
			$is_revision = wp_is_post_revision( $post_id );

			$is_valid_nonce = ( wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['dostart_settings_meta_box_nonce'] ) ), basename( __FILE__ ) ) ) ? true : false;

			// Exits script depending on save status.
			if ( $is_autosave || $is_revision || ! $is_valid_nonce ) {
				return;
			}


        // Sanitize user input.
        $header_data = sanitize_text_field($_POST['dostart-header-status']);
        $breadcrumb_data = sanitize_text_field($_POST['dostart-breadcrumb-status']); 
        $widget_data = sanitize_text_field($_POST['dostart-widget-status']);
        $footer_data = sanitize_text_field($_POST['dostart-footer-status']);

        // Update the meta field in the database.
        update_post_meta($post_id, 'dostart-header-status', $header_data);
        update_post_meta($post_id, 'dostart-breadcrumb-status', $breadcrumb_data); 
        update_post_meta($post_id, 'dostart-widget-status', $widget_data);
        update_post_meta($post_id, 'dostart-footer-status', $footer_data);
    }
}

Dostart_Meta::get_instance()->init();
