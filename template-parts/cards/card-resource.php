<?php
/**
 * Compact resource card.
 *
 * Replaces the Elementor loop-item template "Resources Home card" (83):
 * rules above and below, title, excerpt and a "Read more" link.
 *
 * @package freemantech
 */

?>
<article <?php post_class( 'ft-card ft-card--resource' ); ?>>

	<h2 class="ft-card__title ft-title-sm"><?php the_title(); ?></h2>

	<div class="ft-card__excerpt ft-card__excerpt--fixed"><?php freemantech_the_excerpt(); ?></div>

	<div class="simple-read-more btn-blue ft-card__more">
		<a href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more', 'freemantech' ); ?></a>
	</div>

</article>
