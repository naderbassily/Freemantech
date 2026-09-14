<?php
/**
 * Resource Filter Shortcode with AJAX
 * Usage: [resource_filter]
 */

function resource_filter_shortcode($atts) {
    // Shortcode attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => 12,
    ), $atts);
    
    ob_start();
    ?>
    
    <div class="freeman-resource-filter-wrapper">
        
        <div class="filter-container">
            <!-- Left Sidebar - Filters (30%) -->
            <div class="filters-sidebar">
                <h3 class="filter-title">Filter </h3>
                
                <form id="resourceFilterForm" class="filter-form">
                    
                    <!-- Search Field -->
                    <div class="filter-group">
                        <label>Search</label>
                        <input type="text" 
                               name="resource_search" 
                               id="resource_search"
                               placeholder="Search resources..." 
                               value="<?php echo esc_attr(isset($_GET['resource_search']) ? $_GET['resource_search'] : ''); ?>">
                    </div>

                    <!-- Application Taxonomy -->
                    <?php
                    $applications = get_terms(array(
                        'taxonomy' => 'application',
                        'hide_empty' => true,
                    ));
                    if (!empty($applications) && !is_wp_error($applications)) : ?>
                    <div class="filter-group">
                        <select name="application" id="application">
                            <option value="">All Applications</option>
                            <?php foreach ($applications as $app) : ?>
                                <option value="<?php echo esc_attr($app->slug); ?>" 
                                        <?php selected(isset($_GET['application']) ? $_GET['application'] : '', $app->slug); ?>>
                                    <?php echo esc_html($app->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <!-- Class Taxonomy -->
                    <?php
                    $classes = get_terms(array(
                        'taxonomy' => 'class',
                        'hide_empty' => true,
                    ));
                    if (!empty($classes) && !is_wp_error($classes)) : ?>
                    <div class="filter-group">
                        <select name="class" id="class">
                            <option value="">Resource Type</option>
                            <?php foreach ($classes as $class) : ?>
                                <option value="<?php echo esc_attr($class->slug); ?>" 
                                        <?php selected(isset($_GET['class']) ? $_GET['class'] : '', $class->slug); ?>>
                                    <?php echo esc_html($class->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <?php endif; ?>

                    <!-- Filter Buttons -->
                    <div class="filter-actions">
                        <button type="submit" class="btn-filter">Filter</button>
                        <button type="button" class="btn-reset" id="resetFilter">Reset</button>
                    </div>
                </form>
            </div>

            <!-- Right Content - Results (70%) -->
            <div class="results-container">
                <div class="loading-overlay" style="display: none;">
                    <div class="spinner"></div>
                </div>
                
                <div class="resources-results" id="resourcesResults">
                    <?php echo get_filtered_resources($atts['posts_per_page']); ?>
                </div>
            </div>
        </div>
        
    </div>

    <style>
    .freeman-resource-filter-wrapper {
        width: 100%;
    }
    
    .filter-container {
        display: grid;
        grid-template-columns: 30% 70%;
        gap: 30px;
        align-items: start;
    }
    
    /* Left Sidebar - Filters */
    .filters-sidebar {
        background: #f8f9fa;
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        position: sticky;
        top: 20px;
    }
    
    .filter-title {
        margin: 0 0 20px 0;
        font-size: 20px;
        color: #333;
        padding-bottom: 15px;
    }
    
    .filter-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    
    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }
    
    .filter-group label {
        font-weight: 600;
        color: #555;
        font-size: 14px;
    }
    
    .filter-group input,
    .filter-group select {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s;
        background: white;
    }
    
    .filter-group input:focus,
    .filter-group select:focus {
        outline: none;
        border-color: var(--e-global-color-primary);
    }
    
    .filter-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 10px;
    }
    
    .btn-filter,
    .btn-reset {
        padding: 12px 25px;
        border-radius: 5px;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        border: none;
        width: 100%;
    }
    
    .btn-filter {
        background: var(--e-global-color-primary);
        color: white;
    }
    
    .btn-filter:hover {
        background: #005a87;
    }
    
    .btn-reset {
        background: white;
        color: #333;
        border: 1px solid #ddd;
    }
    
    .btn-reset:hover {
        background: #f0f0f0;
    }
    
    /* Right Content - Results */
    .results-container {
        position: relative;
        min-height: 400px;
    }
    
    .loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255,255,255,0.8);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 10;
        border-radius: 8px;
    }
    
    .spinner {
        border: 4px solid #f3f3f3;
        border-top: 4px solid var(--e-global-color-primary);
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Results Grid - Single Column */
    .resources-grid {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    
    .resource-item {
        background: white;
        border-radius: 8px;
        padding: 15px;
        border: 1px solid #eee;
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        grid-template-columns: 250px 1fr;
        gap: 20px;
    }
    
    .resource-item:hover {
        transform: translateX(5px);
        box-shadow: 0 4px 15px rgba(0,0,0,0.12);
    }
    
    .resource-thumbnail {
        width: 250px;
        height: 200px;
        overflow: hidden;
    }
    
    .resource-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .resource-content {
        padding: 20px 20px 20px 0;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .resource-title {
        margin: 0 0 10px 0;
        font-size: 22px;
    }
    
    .resource-title a {
        color: #333;
        text-decoration: none;
    }
    
    .resource-title a:hover {
        color:var(--e-global-color-primary);
    }
    
    .resource-excerpt {
        color: #666;
        margin-bottom: 15px;
        line-height: 1.6;
    }
    
    .resource-meta {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }
    
    .resource-type,
    .resource-class {
        display: inline-block;
        color:var(--e-global-color-primary);
        
  
        font-size: 12px;
        font-weight: 600;
    }
    
    .resource-class:before {
        content: "Type:"
    }
    
    .resource-link {
        color: var(--e-global-color-primary);
        text-decoration: none;
        font-weight: 600;
    }
    
    .resource-link:hover {
        text-decoration: underline;
    }
    
    .no-resources {
        text-align: center;
        padding: 60px 20px;
        color: #999;
        font-size: 18px;
        background: #f8f9fa;
        border-radius: 8px;
    }
    
    /* Pagination */
    .resources-pagination {
        display: flex;
        justify-content: center;
        gap: 10px;
        margin-top: 40px;
    }
    
    .resources-pagination a,
    .resources-pagination span {
        padding: 10px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: #333;
    }
    
    .resources-pagination .current {
        background: var(--e-global-color-primary);
        color: white;
        border-color: var(--e-global-color-primary);
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .filter-container {
            grid-template-columns: 35% 65%;
        }
    }
    
    @media (max-width: 768px) {
        .filter-container {
            grid-template-columns: 1fr;
        }
        
        .filters-sidebar {
            position: static;
        }
        
        .resource-item {
            grid-template-columns: 1fr;
        }
        
        .resource-thumbnail {
            width: 100%;
            height: 200px;
        }
        
        .resource-content {
            padding: 20px;
        }
    }
    </style>
    
    <script>
    jQuery(document).ready(function($) {
        const form = $('#resourceFilterForm');
        const resultsContainer = $('#resourcesResults');
        const loadingOverlay = $('.loading-overlay');
        
        // Handle form submission
        form.on('submit', function(e) {
            e.preventDefault();
            filterResources();
        });
        
        // Handle reset button
        $('#resetFilter').on('click', function() {
            form[0].reset();
            filterResources();
        });
        
        // AJAX filter function
        function filterResources(page = 1) {
            loadingOverlay.show();
            
            $.ajax({
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                type: 'POST',
                data: {
                    action: 'filter_resources',
                    search: $('#resource_search').val(),
                    application: $('#application').val(),
                    class: $('#class').val(),
                    paged: page,
                    posts_per_page: <?php echo $atts['posts_per_page']; ?>
                },
                success: function(response) {
                    resultsContainer.html(response);
                    loadingOverlay.hide();
                    
                    // Scroll to results
                    $('html, body').animate({
                        scrollTop: resultsContainer.offset().top - 100
                    }, 500);
                },
                error: function() {
                    loadingOverlay.hide();
                    resultsContainer.html('<p class="no-resources">Error loading resources. Please try again.</p>');
                }
            });
        }
        
        // Handle pagination clicks
        $(document).on('click', '.resources-pagination a', function(e) {
            e.preventDefault();
            const page = $(this).attr('href').match(/paged=(\d+)/);
            if (page) {
                filterResources(page[1]);
            }
        });
    });
    </script>
    
    <?php
    return ob_get_clean();
}
add_shortcode('resource_filter', 'resource_filter_shortcode');

// Function to get filtered resources
function get_filtered_resources($posts_per_page = 12, $paged = 1) {
    // Build query arguments
    $args = array(
        'post_type' => 'resources',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
    );
    
    // Add tax query
    $tax_query = array('relation' => 'AND');
    
    if (!empty($_POST['application']) || !empty($_GET['application'])) {
        $app = !empty($_POST['application']) ? $_POST['application'] : $_GET['application'];
        $tax_query[] = array(
            'taxonomy' => 'application',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($app),
        );
    }
    
    if (!empty($_POST['class']) || !empty($_GET['class'])) {
        $class = !empty($_POST['class']) ? $_POST['class'] : $_GET['class'];
        $tax_query[] = array(
            'taxonomy' => 'class',
            'field'    => 'slug',
            'terms'    => sanitize_text_field($class),
        );
    }
    
    if (count($tax_query) > 1) {
        $args['tax_query'] = $tax_query;
    }
    
    // Add search
    if (!empty($_POST['search']) || !empty($_GET['resource_search'])) {
        $search = !empty($_POST['search']) ? $_POST['search'] : $_GET['resource_search'];
        $args['s'] = sanitize_text_field($search);
    }
    
    // Run the query
    $resources_query = new WP_Query($args);
    
    ob_start();
    
    if ($resources_query->have_posts()) :
        echo '<div class="resources-grid">';
        
        while ($resources_query->have_posts()) : $resources_query->the_post();
            ?>
            <div class="resource-item">
                <?php if (has_post_thumbnail()) : ?>
                    <div class="resource-thumbnail">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    </div>
                <?php endif; ?>
                
                <div class="resource-content">
                     <div class="resource-meta">
                        <?php
                        $apps = get_the_terms(get_the_ID(), 'application');
                        if ($apps && !is_wp_error($apps)) {
                            echo '<span class="resource-type">' . esc_html($apps[0]->name) . '</span>';
                        }
                        
                        $classes = get_the_terms(get_the_ID(), 'class');
                        if ($classes && !is_wp_error($classes)) {
                            echo '<span class="resource-class">' . esc_html($classes[0]->name) . '</span>';
                        }
                        ?>
                    </div>
                    <h3 class="resource-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h3>
                    
                    <div class="resource-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt(), 30); ?>
                    </div>
                    
                   
                    
                    <a href="<?php the_permalink(); ?>" class="resource-link">Read More →</a>
                </div>
            </div>
            <?php
        endwhile;
        
        echo '</div>';
        
        // Pagination
        if ($resources_query->max_num_pages > 1) :
            echo '<div class="resources-pagination">';
            echo paginate_links(array(
                'total' => $resources_query->max_num_pages,
                'current' => max(1, $paged),
                'prev_text' => '← Previous',
                'next_text' => 'Next →',
                'format' => '?paged=%#%',
            ));
            echo '</div>';
        endif;
        
    else :
        echo '<p class="no-resources">No resources found matching your criteria.</p>';
    endif;
    
    wp_reset_postdata();
    
    return ob_get_clean();
}

// AJAX handler
function ajax_filter_resources() {
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;
    $posts_per_page = isset($_POST['posts_per_page']) ? intval($_POST['posts_per_page']) : 12;
    
    echo get_filtered_resources($posts_per_page, $paged);
    
    wp_die();
}
add_action('wp_ajax_filter_resources', 'ajax_filter_resources');
add_action('wp_ajax_nopriv_filter_resources', 'ajax_filter_resources');