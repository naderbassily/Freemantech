<?php
/**
 * Accessory card.
 *
 * Replaces the Elementor loop-item template "Accessories loop card" (1109).
 *
 * @package freemantech
 */

?>
<a class="ft-card ft-card--accessory" href="<?php the_permalink(); ?>">

	<?php if ( has_post_thumbnail() ) : ?>
		<?php the_post_thumbnail( 'large', array( 'class' => 'ft-card__image', 'alt' => '' ) ); ?>
	<?php endif; ?>

	<h3 class="ft-card__title"><?php the_title(); ?></h3>

</a>
