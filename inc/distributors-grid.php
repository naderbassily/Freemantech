<?php
/**
 * Distributors Grid
 * 
 * Displays ACF repeater distributors in a 4-column grid
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue distributors grid assets
 */
function distributors_grid_enqueue_assets() {
    // CSS
    wp_enqueue_style(
        'distributors-grid-css',
        get_template_directory_uri() . '/assets/css/distributors-grid.css',
        array(),
        filemtime(get_template_directory() . '/assets/css/distributors-grid.css')
    );
}
add_action('wp_enqueue_scripts', 'distributors_grid_enqueue_assets');

/**
 * Distributors Grid Shortcode
 * 
 * Usage: [distributors_grid]
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function distributors_grid_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'field' => 'distributors', // ACF field name
    ), $atts);
    
    // Get ACF repeater field
    $distributors = get_field($atts['field']);
    
    // Return empty if no distributors
    if (!$distributors || !is_array($distributors)) {
        return '';
    }
    
    // Start output buffering
    ob_start();
    ?>
    
    <div class="distributors-grid-wrapper">
        <div class="distributors-grid">
            <?php foreach ($distributors as $distributor): ?>
            <div class="distributor-card">
                <div class="distributor-content">
                    <?php if (!empty($distributor['country'])): ?>
                        <h3 class="distributor-country"><?php echo esc_html($distributor['country']); ?></h3>
                    <?php endif; ?>
                    
                    <?php if (!empty($distributor['distributor_address'])): ?>
                        <div class="distributor-address">
                            <?php echo wp_kses_post($distributor['distributor_address']); ?>
                        </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($distributor['distributor_phone'])): ?>
                        <div class="distributor-phone">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9+]/', '', $distributor['distributor_phone'])); ?>">
                                <?php echo esc_html($distributor['distributor_phone']); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('distributors_grid', 'distributors_grid_shortcode');