<?php
/**
 * "How it works" tabs on the product page.
 *
 * Replaces the Elementor nested-tabs widget (538d260).
 *
 * @package freemantech
 */

$freemantech_tabs = array(
	array(
		'id'    => 'technology',
		'title' => __( 'Technology', 'freemantech' ),
		'path'  => '2026/01/ft4-tecnolgy.jpg',
		'text'  => array(
			__( 'The FT4 employs unique technology for measuring the resistance of the powder to flow, whilst the powder is in motion. A precision ‘blade’ is rotated and moved downwards through the powder to establish a precise flow pattern. This causes many thousands of particles to interact, or flow relative to one another, and the resistance experienced by the blade represents the difficulty of this relative particle movement, or the bulk flow properties.', 'freemantech' ),
			__( 'Excellent reproducibility and sensitivity, this is achieved by moving the blade in a precise and reliable way. The advanced control systems of the FT4 accurately set the rotational and vertical speeds of the blade, which defines the Helix Angle and Tip Speed.', 'freemantech' ),
		),
	),
	array(
		'id'    => 'parameters',
		'title' => __( 'A unique set of measured parameters', 'freemantech' ),
		'path'  => '2026/01/A-unique-set-of-measured-parameters.jpg',
		'text'  => array(
			__( 'The dynamic principle of the FT4 requires that the blade rotates and moves vertically, both downwards and upwards. As a result, it will experience a resistance to rotation and a resistance to vertical movement.', 'freemantech' ),
			__( 'The FT4 measures both rotational and vertical resistances, in the form of Torque and Force, respectively. Both signals need to be measured, as it is the composite of these two signals that quantifies the powder’s total resistance to flow.', 'freemantech' ),
		),
	),
	array(
		'id'      => 'accuracy',
		'title'   => __( 'Accuracy', 'freemantech' ),
		'path'    => '2026/01/Ft4-hero.webp',
		'boxed'   => true,
		'text'    => array(
			__( 'Excluding either Torque or Force signals would result in misleading data, as the calculated Flow Energy value would not represent the powder’s total resistance to flow.', 'freemantech' ),
			__( 'Due to the rotational nature of the technique, approximately 90% of the total resistance is contributed from the Torque signal, with the remaining 10% from the Force component.', 'freemantech' ),
			__( 'This highlights the importance of measuring Torque as well as Force when evaluating rheological properties.', 'freemantech' ),
		),
	),
);
?>
<div class="ft-tabs" data-ft-tabs>

	<div class="ft-tabs__list" role="tablist">
		<?php foreach ( $freemantech_tabs as $index => $freemantech_tab ) : ?>
			<button
				type="button"
				class="ft-tabs__tab<?php echo 0 === $index ? ' is-active' : ''; ?>"
				id="tab-<?php echo esc_attr( $freemantech_tab['id'] ); ?>"
				role="tab"
				aria-controls="panel-<?php echo esc_attr( $freemantech_tab['id'] ); ?>"
				aria-selected="<?php echo 0 === $index ? 'true' : 'false'; ?>">
				<?php echo esc_html( $freemantech_tab['title'] ); ?>
			</button>
		<?php endforeach; ?>
	</div>

	<?php foreach ( $freemantech_tabs as $index => $freemantech_tab ) : ?>
		<div
			class="ft-tabs__panel"
			id="panel-<?php echo esc_attr( $freemantech_tab['id'] ); ?>"
			role="tabpanel"
			aria-labelledby="tab-<?php echo esc_attr( $freemantech_tab['id'] ); ?>"
			<?php echo 0 === $index ? '' : 'hidden'; ?>>

			<div class="ft-tabs__text">
				<?php foreach ( $freemantech_tab['text'] as $freemantech_paragraph ) : ?>
					<p><?php echo esc_html( $freemantech_paragraph ); ?></p>
				<?php endforeach; ?>
			</div>

			<div class="ft-tabs__media<?php echo empty( $freemantech_tab['boxed'] ) ? '' : ' ft-tabs__media--boxed'; ?>">
				<?php freemantech_asset_image( $freemantech_tab['path'], array( 'alt' => '', 'loading' => 'lazy' ) ); ?>
			</div>

		</div>
	<?php endforeach; ?>

</div>
