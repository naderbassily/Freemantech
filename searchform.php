<?php
/**
 * Search form.
 *
 * Mirrors the former Elementor Search widget: a single field on the pale blue
 * ground that submits on Enter.
 *
 * @package freemantech
 */

$freemantech_search_id = 'ft-search-' . wp_unique_id();
?>
<form role="search" method="get" class="ft-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="ft-screen-reader-text" for="<?php echo esc_attr( $freemantech_search_id ); ?>">
		<?php esc_html_e( 'Search', 'freemantech' ); ?>
	</label>
	<input
		type="search"
		id="<?php echo esc_attr( $freemantech_search_id ); ?>"
		class="ft-search__input"
		placeholder="<?php esc_attr_e( 'Search', 'freemantech' ); ?>"
		value="<?php echo get_search_query(); ?>"
		name="s" />
	<button type="submit" class="ft-search__submit">
		<span class="ft-screen-reader-text"><?php esc_html_e( 'Search', 'freemantech' ); ?></span>
		<svg viewBox="0 0 512 512" width="15" height="15" aria-hidden="true" focusable="false"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
	</button>
</form>
