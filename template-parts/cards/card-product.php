<?php
/**
 * Product card.
 *
 * Replaces the Elementor loop-item template "Product Card" (666). The whole
 * card is the link, as it was when the container's HTML tag was set to <a>.
 *
 * @package freemantech
 */

?>
<a class="ft-card ft-card--product" href="<?php the_permalink(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'large', array( 'class' => 'ft-card__image', 'alt' => '' ) ); ?>
	<?php endif; ?>

	<h2 class="ft-card__title"><?php the_title(); ?></h2>

	<div class="ft-card__excerpt"><?php freemantech_the_excerpt(); ?></div>

</a>
