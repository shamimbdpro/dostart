<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dostart
 */

if ( ! defined('ABSPATH') ) {
	exit; // Exit if accessed directly.
}
// $social_share = get_theme_mod( 'dostart_blog_social_share', true ); 
$dostart_excerpt_length = ! empty(get_theme_mod('dostart_blog_excerpt_length')) ? get_theme_mod('dostart_blog_excerpt_length') : '25';

?>
<?php if ( is_single() ) : ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="dostart-post">

			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post_thumbnail">
					<?php the_post_thumbnail('full'); ?>
					<span class="excerpt-date"><?php echo esc_html(the_modified_date()); ?></span>
				</div>
			<?php endif ?>

			<div class="dostart-post-content">
				<div class="entry-meta">

					<ul class="list-inline">

						<?php do_action('before_post_meta'); ?>

						<li class="list-inline-item">
							<i class="fa fa-user"></i> <?php echo esc_html__('by', 'dostart'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
						</li>
						<li class="list-inline-item">
							<i class="fa fa-comment"></i> <a href="<?php comments_link(); ?>"><?php printf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'dostart'), number_format_i18n(get_comments_number())); ?></a>
						</li>
						<li class="list-inline-item">
							<i class="fa fa-tags"></i>
							<?php
							$categories = get_the_category();
							if ( ! empty($categories) ) {
								echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
							}
							?>
						</li>

						<?php do_action('after_post_meta'); ?>

					</ul>

				</div><!-- .entry-meta -->

                <header class="entry-header">
                    <h1><?php wp_title('', true); ?></h1>
                </header><!-- .entry-header -->
				<div class="entry-content">
					<?php
					the_content(
						sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'dostart'),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						)
					);

					wp_link_pages(
						array(
							'before' => '<div class="page-links">' . esc_html__('Pages:', 'dostart'),
							'after'  => '</div>',
						)
					);
					?>
				</div><!-- .entry-content -->


				<?php if ( get_the_tags() ) : ?>
					<div class="tags">
						<?php the_tags($before = 'Tags: ', ' ', ''); ?>
					</div>
				<?php endif ?>


			</div> <!-- end post content. -->


		</div>


	</article>


<?php else : ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<div class="dostart-post">
			<?php if ( has_post_thumbnail() ) : ?>
				<div class="post_thumbnail">
					<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail('full'); ?>
					</a>
					<span class="excerpt-date"><?php echo esc_html(the_modified_date()); ?></span>
				</div>
			<?php endif ?>
			<div class="dostart-post-content">
				<div class="entry-meta">
					<ul class="list-inline">

						<?php do_action('before_post_meta'); ?>

						<li class="list-inline-item">
							<i class="fa fa-user"></i> <?php echo esc_html__('by', 'dostart'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a>
						</li>
						<li class="list-inline-item">
							<i class="fa fa-comment"></i> <a href="<?php comments_link(); ?>"><?php printf(_nx('1 Comment', '%1$s Comments', get_comments_number(), 'comments title', 'dostart'), number_format_i18n(get_comments_number())); ?></a>
						</li>
						<li class="list-inline-item">
							<i class="fa fa-tags"></i>
							<?php
							$categories = get_the_category();
							if ( ! empty($categories) ) {
								echo '<a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a>';
							}
							?>
						</li>

						<?php do_action('after_post_meta'); ?>

					</ul>
				</div><!-- .entry-meta -->
				<header class="entry-header">
					<?php the_title('<h3 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h3>'); ?>
				</header><!-- .entry-header -->

				<p><?php echo wp_trim_words(get_the_content(), $dostart_excerpt_length, '...'); ?></p>

				<div class="excerpt-readmore">
					<a href="<?php the_permalink(); ?>"><?php echo esc_html__('Read More', 'dostart'); ?></a>
				</div>
			</div>
		</div>
	</article>

<?php endif ?>