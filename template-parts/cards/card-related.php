<?php
/**
 * Related resource card.
 *
 * Replaces the Elementor loop-item template "Related resource Card" (536).
 *
 * @package freemantech
 */

?>
<article <?php post_class( 'ft-card ft-card--related' ); ?>>

	<h3 class="ft-card__title"><?php the_title(); ?></h3>

	<div class="ft-card__excerpt"><?php the_excerpt(); ?></div>

	<div class="simple-read-more btn-blue ft-card__more">
		<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'freemantech' ); ?></a>
	</div>

</article>
