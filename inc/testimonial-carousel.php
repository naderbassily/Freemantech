<?php
/**
 * Testimonial Carousel
 * 
 * Displays ACF repeater testimonials in a Swiper carousel
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue testimonial carousel assets
 */
function testimonial_carousel_enqueue_assets() {
    /*
     * Swiper drives three things: the testimonial carousel (About us), and the
     * application carousels on the front page and the product page. Loading it
     * everywhere put a render-blocking CDN stylesheet on pages with no carousel
     * at all.
     */
    $needs_swiper = is_front_page()
        || is_singular( 'product' )
        || is_page( 'about-us' );

    /** Filter which views load the carousel assets. */
    if ( ! apply_filters( 'freemantech_needs_carousel', $needs_swiper ) ) {
        return;
    }

    // Swiper CSS from CDN
    wp_enqueue_style(
        'swiper-css',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
        array(),
        '11.0.0'
    );
    
    // Custom CSS
    wp_enqueue_style(
        'testimonial-carousel-css',
        get_template_directory_uri() . '/assets/css/testimonial-carousel.css',
        array('swiper-css'),
        filemtime(get_template_directory() . '/assets/css/testimonial-carousel.css')
    );
    
    // Swiper JS from CDN
    wp_enqueue_script(
        'swiper-js',
        'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
        array(),
        '11.0.0',
        true
    );
    
    // Custom JS - Load after Swiper
    wp_enqueue_script(
        'testimonial-carousel-js',
        get_template_directory_uri() . '/js/testimonial-carousel.js',
        array('jquery', 'swiper-js'),
        filemtime(get_template_directory() . '/js/testimonial-carousel.js'),
        true
    );
}
add_action('wp_enqueue_scripts', 'testimonial_carousel_enqueue_assets');

/**
 * Testimonial Carousel Shortcode
 * 
 * Usage: [testimonial_carousel]
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function testimonial_carousel_shortcode($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'field' => 'testimonial', // ACF field name
    ), $atts);
    
    // Get ACF repeater field
    $testimonials = get_field($atts['field']);
    
    // Return empty if no testimonials
    if (!$testimonials || !is_array($testimonials)) {
        return '';
    }
    
    // Start output buffering
    ob_start();
    ?>
    
    <div class="testimonial-carousel-wrapper">
        <div class="swiper testimonial-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($testimonials as $testimonial): ?>
                <div class="swiper-slide">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">
                            <svg class="quote-icon" width="40" height="40" viewBox="0 0 40 40" fill="none">
                                <path d="M10 20C10 15 13 10 18 8V12C15 13 13 15 13 18H18V28H10V20ZM24 20C24 15 27 10 32 8V12C29 13 27 15 27 18H32V28H24V20Z" fill="currentColor"/>
                            </svg>
                            <p><?php echo esc_html($testimonial['testimonial-quote']); ?></p>
                        </div>
                        <div class="testimonial-author">
                            <div class="author-info">
                                <h4><?php echo esc_html($testimonial['author']); ?></h4>
                                <p class="author-title"><?php echo esc_html($testimonial['titleposition']); ?></p>
                                <?php if (!empty($testimonial['company'])): ?>
                                    <p class="author-company"><?php echo esc_html($testimonial['company']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    
    <?php
    return ob_get_clean();
}
add_shortcode('testimonial_carousel', 'testimonial_carousel_shortcode');