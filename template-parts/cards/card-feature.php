<?php
/**
 * Card with featured image.
 *
 * Replaces the Elementor loop-item template "Card with Feature image" (187).
 * Featured image, title, excerpt and a "Read more" link to the post.
 *
 * @package freemantech
 */

?>
<article <?php post_class( 'ft-card ft-card--feature' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="ft-card__media">
			<?php the_post_thumbnail( 'large', array( 'class' => 'ft-card__image', 'alt' => '' ) ); ?>
		</div>
	<?php endif; ?>

	<div class="ft-card__body">
		<h2 class="ft-card__title ft-title-sm"><?php the_title(); ?></h2>

		<?php if ( freemantech_has_excerpt() ) : ?>
			<div class="ft-card__excerpt"><?php freemantech_the_excerpt(); ?></div>
		<?php endif; ?>

		<div class="simple-read-more btn-blue ft-card__more">
			<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'freemantech' ); ?></a>
		</div>
	</div>

</article>
