<?php
/**
 * Software Repeater Table
 * Display ACF repeater field in a clean table format
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Render Software Repeater Table
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output
 */
function render_software_repeater_table($atts) {
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'field_name' => 'software', // ACF repeater field name
        'post_id' => get_the_ID(), // Current post ID by default
    ), $atts);
    
    // Get the repeater field data
    $software_items = get_field($atts['field_name'], $atts['post_id']);
    
    // Return empty if no data
    if (!$software_items || !is_array($software_items)) {
        return '';
    }
    
    // Start output buffering
    ob_start();
    ?>
    
    <div class="software-repeater-table-wrapper">
        <table class="software-repeater-table">
            <thead>
                <tr>
                    <th class="col-description">Description</th>
                    <th class="col-note">Note</th>
                    <th class="col-download">Download</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($software_items as $item) : 
                    $description = isset($item['software-description']) ? esc_html($item['software-description']) : '';
                    $note = isset($item['software-note']) ? esc_html($item['software-note']) : '';
                    $download_link = isset($item['download_link']) ? $item['download_link'] : '';
                ?>
                <tr>
                    <td class="col-description">
                        <span class="mobile-label">Description</span>
                        <?php echo $description; ?>
                    </td>
                    <td class="col-note">
                        <span class="mobile-label">Note</span>
                        <?php echo $note; ?>
                    </td>
                    <td class="col-download">
                        <span class="mobile-label">Download</span>
                        <?php if ($download_link) : ?>
                            <a href="<?php echo esc_url($download_link); ?>" 
                               class="download-link" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               aria-label="Download <?php echo esc_attr($description); ?>">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12 15.5L7.5 11L8.9 9.6L11 11.7V4H13V11.7L15.1 9.6L16.5 11L12 15.5Z" fill="currentColor"/>
                                    <path d="M5 20C4.45 20 3.979 19.804 3.587 19.412C3.195 19.02 3 18.549 3 18V15H5V18H19V15H21V18C21 18.55 20.804 19.021 20.412 19.413C20.02 19.805 19.549 20 19 20H5Z" fill="currentColor"/>
                                </svg>
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?php
    return ob_get_clean();
}

// Register the shortcode
add_shortcode('software_table', 'render_software_repeater_table');

/**
 * Enqueue styles for the software repeater table
 */
function enqueue_software_repeater_styles() {
    wp_enqueue_style(
        'software-repeater-table',
        get_template_directory_uri() . '/assets/css/software-repeater-table.css',
        array(),
        '1.0.0'
    );
}
add_action('wp_enqueue_scripts', 'enqueue_software_repeater_styles');
