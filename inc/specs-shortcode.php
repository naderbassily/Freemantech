<?php
if (!defined('ABSPATH')) exit;

function mp_product_specifications_shortcode() {

  // Check if ACF is available and has data
  if (!function_exists('have_rows') || !have_rows('specifications')) {
    return '';
  }

  $cats = [];

  // Loop through each category
  while (have_rows('specifications')) : the_row();
    $cat_label = get_sub_field('category_label');

    $items = [];
    
    // Loop through spec items within this category
    if (have_rows('spec_item')) {
      while (have_rows('spec_item')) : the_row();
        $items[] = [
          'label' => get_sub_field('spec_label'),
          'value' => get_sub_field('spec_value'),
        ];
      endwhile;
    }

    $cats[] = [
      'label' => $cat_label,
      'items' => $items,
    ];
  endwhile;

  if (empty($cats)) return '';

  $uid = 'specs_' . get_the_ID() . '_' . wp_rand(1000, 9999);

  ob_start();
  ?>
  <div class="mp-specs" id="<?php echo esc_attr($uid); ?>">

    <div class="mp-specs__tabs">
      <?php foreach ($cats as $i => $cat): ?>
        <button
          class="mp-specs__tab <?php echo $i === 0 ? 'is-active' : ''; ?>"
          type="button"
          data-tab="<?php echo esc_attr($i); ?>"
        >
          <?php echo esc_html($cat['label'] ?: 'Category'); ?>
        </button>
      <?php endforeach; ?>
    </div>

    <div class="mp-specs__panels">
      <?php foreach ($cats as $i => $cat): ?>
        <div
          class="mp-specs__panel <?php echo $i === 0 ? 'is-active' : ''; ?>"
          data-panel="<?php echo esc_attr($i); ?>"
          <?php echo $i === 0 ? '' : 'hidden'; ?>
        >
          <?php if (!empty($cat['items'])): ?>
            <div class="mp-specs__rows">
              <?php foreach ($cat['items'] as $row): ?>
                <?php
                  $label = trim((string) $row['label']);
                  $value = $row['value']; // Keep raw value for WYSIWYG
                  if ($label === '' && $value === '') continue;
                ?>
                <div class="mp-specs__row">
                  <div class="mp-specs__label"><?php echo esc_html($label); ?></div>
                  <div class="mp-specs__value"><?php echo wp_kses_post($value); ?></div>
                </div>
              <?php endforeach; ?>
            </div>
          <?php else: ?>
            <div class="mp-specs__empty">No specs available for this category.</div>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>

  </div>
  <?php
  return ob_get_clean();
}

add_shortcode('product_specs', 'mp_product_specifications_shortcode');