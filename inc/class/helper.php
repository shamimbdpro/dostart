<?php

/**
 * Dostart Helper
 */
if (!class_exists('DostartHelper')) {

    class DostartHelper
    {

        /**
         * Social sahre button.
         * @return string
         */
        public static function social_share()
        {

            $soical_share_open_new_tab = 1 == get_theme_mod('dostart_blog_social_share_open_new_tab', true) ? '_blank' : ''; ?>

            <div class="social-share list-inline">
                <ul class="list-inline-item">
                    <li class="list-inline-item">
                        <a target="<?php echo esc_attr($soical_share_open_new_tab); ?>" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_url_raw(wp_unslash(get_the_permalink())) ?>">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a target="<?php echo esc_attr($soical_share_open_new_tab); ?>" href="https://www.twitter.com/share?url=<?php echo esc_url_raw(wp_unslash(get_the_permalink())) ?>">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a target="<?php echo esc_attr($soical_share_open_new_tab); ?>" href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url_raw(wp_unslash(get_the_permalink())) ?>">
                            <i class="fab fa-pinterest"> </i>
                        </a>
                    </li>
                </ul>
            </div>
<?php
        }


        // function to display number of posts.
        public static function getPostViews($postID)
        {
            $count_key = 'post_views_count';
            $count = get_post_meta($postID, $count_key, true);
            if ($count == '') {
                delete_post_meta($postID, $count_key);
                add_post_meta($postID, $count_key, '0');
                return "0";
            }
            return $count . '';
        }

        // function to count views.
        public static function setPostViews($postID)
        {
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $key = $user_ip . 'x' . $postID;
            $value = array($user_ip, $postID);
            $visited = get_transient($key);
            if (false === ($visited)) {
                set_transient($key, $value, 100);
                $count_key = 'post_views_count';
                $count = get_post_meta($postID, $count_key, true);
                if ($count == '') {
                    $count = 0;
                    delete_post_meta($postID, $count_key);
                    add_post_meta($postID, $count_key, '0');
                } else {
                    $count++;
                    update_post_meta($postID, $count_key, $count);
                }
            }
        }


    } // End Class.
}
