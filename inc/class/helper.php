<?php



/**
 * Related Posts
 * @return array|mixed
 */
function dostart_related_posts() {
	$related_post = get_theme_mod( 'dostart_blog_related_post', true );
	if ( true === $related_post ) {
		$posts_per_page        = ! empty( get_theme_mod( 'dostart_related_post_limit' ) ) ? get_theme_mod( 'dostart_related_post_limit' ) : '3';
		$related_posts_columns = ! empty( get_theme_mod( 'dostart_blog_post_column' ) ) ? get_theme_mod( 'dostart_blog_post_column' ) : '4';
		$related_post_title    = ! empty( get_theme_mod( 'dostart_related_post_title' ) ) ? get_theme_mod( 'dostart_related_post_title' ) : 'Related Posts';

		global $post;

		$related = get_posts(
			array(
				'category__in'   => wp_get_post_categories( $post->ID ),
				'posts_per_page' => $posts_per_page,
				'post_type'      => 'post',
				'post__not_in'   => array( $post->ID ),
			)
		);?>

		<?php if ( $related ) : ?>
		<div class="related-posts">
		  <h4><?php echo esc_html( $related_post_title ); ?></h4>
		  <div class="row">
			  <?php
				if ( $related ) {
					foreach ( $related as $post ) {
						setup_postdata( $post ); ?>

				  <div class="col-md-<?php echo esc_attr( $related_posts_columns ); ?> col-xl-<?php echo esc_attr( $related_posts_columns ); ?>">
					  <div class="single-related-post">
                          <div class="dostart-blog-item">
                              <div class="dostart-blog-item-img">
                            <?php if ( has_post_thumbnail() ) : ?>
                                  <a href="<?php the_permalink(); ?>">
                                      <?php the_post_thumbnail( 'dostart-thumb' ); ?>
                                  </a>
                            <?php endif; ?>
                                  <span>
                                      <?php
                                      $categories = get_the_category();
                                      if ( ! empty( $categories ) ) {
                                          echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
                                      }
                                      ?>
                                  </span>
                              </div>

                              <div class="dostart-blog-item-content">
                                  <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4></a>
                                  <ul class="dostart-blog-item-meta">
                                      <li class="blog-meta-info">
                                          <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>/">
                                              <?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?><?php the_author(); ?></a>
                                      </li>
                                      <li class="blog-item-date"><?php the_time( 'F j, Y' ); ?></li>
                                  </ul>
                              </div>
                          </div>

                      </div>


                  </div>
						<?php
					}
				}
				wp_reset_postdata();
				?>
		  </div>
	  </div><!-- .related-posts -->

	  <?php endif ?>
		<?php
	}
}


/**
 * Display Blog breadcrumb
 * @return string
 */
function dostart_breadcrumb_display() { ?>


    <div class="dostart-breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrumb-inner">
                    <div class="breadcrumb-inner-content">
                        <h1>
                        <?php
                       if ( is_home() && is_front_page() ) {
                           $title = ! empty( get_theme_mod( 'dostart_blog_or_archive_title' ) ) ? get_theme_mod( 'dostart_blog_or_archive_title' ) : esc_html__( 'Blog Posts', 'dostart' );
                       } elseif ( is_home() ) {
                           $title = ! empty( get_theme_mod( 'dostart_blog_or_archive_title' ) ) ? get_theme_mod( 'dostart_blog_or_archive_title' ) : wp_title( '', false );
                       } else {
                           $title = wp_title( '', false );
                       }
                       echo esc_html( $title );
                       ?>
                        </h1>
                        <?php digicart_breadcrumb(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

   <!--END BREADCRUMB AREA-->
   <?php
}



/**
 * Allowed html
 * @return array
 */
function dostart_allowed_html() {
	$allowed_tags = array(
		'a'          => array(
			'class' => array(),
			'href'  => array(),
			'rel'   => array(),
			'title' => array(),
		),
		'abbr'       => array(
			'title' => array(),
		),
		'b'          => array(),
		'blockquote' => array(
			'cite' => array(),
		),
		'cite'       => array(
			'title' => array(),
		),
		'code'       => array(),
		'del'        => array(
			'datetime' => array(),
			'title'    => array(),
		),
		'dd'         => array(),
		'div'        => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'dl'         => array(),
		'dt'         => array(),
		'em'         => array(),
		'h1'         => array(),
		'h2'         => array(),
		'h3'         => array(),
		'h4'         => array(),
		'h5'         => array(),
		'h6'         => array(),
		'i'          => array(),
		'img'        => array(
			'alt'    => array(),
			'class'  => array(),
			'height' => array(),
			'src'    => array(),
			'width'  => array(),
		),
		'li'         => array(
			'class' => array(),
		),
		'ol'         => array(
			'class' => array(),
		),
		'p'          => array(
			'class' => array(),
		),
		'q'          => array(
			'cite'  => array(),
			'title' => array(),
		),
		'span'       => array(
			'class' => array(),
			'title' => array(),
			'style' => array(),
		),
		'strike'     => array(),
		'strong'     => array(),
		'ul'         => array(
			'class' => array(),
		),
	);

	return $allowed_tags;
}