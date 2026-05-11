<?php

add_action('init', function () {
  register_taxonomy('product_category', 'product', [
    'labels' => [
      'name'          => 'Kategorie produktów',
      'singular_name' => 'Kategoria produktów',
      'add_new_item'  => 'Dodaj kategorię',
      'edit_item'     => 'Edytuj kategorię',
      'all_items'     => 'Wszystkie kategorie',
    ],
    'hierarchical'      => false,
    'public'            => false,
    'show_ui'           => true,
    'show_in_rest'      => false,
    'show_admin_column' => true,
    'rewrite'           => false,
    'query_var'         => false,
  ]);

  register_post_type('product', [
    'labels' => [
      'name'          => 'Produkty deli',
      'singular_name' => 'Produkt',
      'add_new'       => 'Dodaj produkt',
      'add_new_item'  => 'Dodaj nowy produkt',
      'edit_item'     => 'Edytuj produkt',
      'all_items'     => 'Wszystkie produkty',
    ],
    'public'       => false,
    'show_ui'      => true,
    'has_archive'  => false,
    'supports'     => ['title'],
    'taxonomies'   => ['product_category'],
    'show_in_rest' => false,
    'menu_icon'    => 'dashicons-food',
  ]);
});

// ── Admin columns ─────────────────────────────────────────────────────────────

add_filter('manage_product_posts_columns', function ($columns) {
  $result = ['enabled' => 'Aktywny'];
  foreach ($columns as $key => $value) {
    $result[$key] = $value;
  }
  return $result;
});

add_action('manage_product_posts_custom_column', function ($column, $post_id) {
  if ($column !== 'enabled') return;
  $on = (bool) get_field('enabled', $post_id);
  echo '<button class="product-toggle' . ($on ? ' product-toggle--on' : '') . '" data-post-id="' . esc_attr($post_id) . '">'
    . ($on ? '✓' : '') . '</button>';
}, 10, 2);

// ── Category enabled column ───────────────────────────────────────────────────

add_filter('manage_edit-product_category_columns', function ($columns) {
  return array_merge(['enabled' => 'Aktywny'], $columns);
});

add_filter('manage_product_category_custom_column', function ($content, $column, $term_id) {
  if ($column !== 'enabled') return $content;
  $on = (bool) get_field('enabled', 'term_' . $term_id);
  return '<button class="product-toggle' . ($on ? ' product-toggle--on' : '') . '" data-term-id="' . esc_attr($term_id) . '">'
    . ($on ? '✓' : '') . '</button>';
}, 10, 3);

// ── Category filter ───────────────────────────────────────────────────────────

add_action('restrict_manage_posts', function ($post_type) {
  if ($post_type !== 'product') return;
  $terms   = get_terms(['taxonomy' => 'product_category', 'hide_empty' => false]);
  $current = $_GET['product_category'] ?? '';
  echo '<select name="product_category">';
  echo '<option value="">Wszystkie kategorie</option>';
  foreach ($terms as $term) {
    echo '<option value="' . esc_attr($term->slug) . '"' . selected($current, $term->slug, false) . '>'
      . esc_html($term->name) . '</option>';
  }
  echo '</select>';
});

add_filter('parse_query', function ($query) {
  global $pagenow;
  if ($pagenow !== 'edit.php') return;
  if (($GLOBALS['typenow'] ?? '') !== 'product') return;
  if (empty($_GET['product_category'])) return;

  $query->query_vars['tax_query'] = [[
    'taxonomy' => 'product_category',
    'field'    => 'slug',
    'terms'    => sanitize_text_field($_GET['product_category']),
  ]];
});

// ── AJAX toggle ───────────────────────────────────────────────────────────────

add_action('wp_ajax_toggle_product_enabled', function () {
  check_ajax_referer('toggle_product_enabled', 'nonce');

  $post_id = intval($_POST['post_id'] ?? 0);
  if (!$post_id || !current_user_can('edit_post', $post_id)) {
    wp_send_json_error();
  }

  $new = !(bool) get_field('enabled', $post_id);
  update_field('enabled', $new, $post_id);
  wp_send_json_success(['enabled' => $new]);
});

// ── AJAX toggle category ─────────────────────────────────────────────────────

add_action('wp_ajax_toggle_category_enabled', function () {
  check_ajax_referer('toggle_category_enabled', 'nonce');

  $term_id = intval($_POST['term_id'] ?? 0);
  if (!$term_id || !current_user_can('manage_categories')) {
    wp_send_json_error();
  }

  $new = !(bool) get_field('enabled', 'term_' . $term_id);
  update_field('enabled', $new, 'term_' . $term_id);
  wp_send_json_success(['enabled' => $new]);
});

// ── Admin assets ──────────────────────────────────────────────────────────────

add_action('admin_head', function () {
  $pagenow          = $GLOBALS['pagenow'] ?? '';
  $is_product_list  = $pagenow === 'edit.php' && ($GLOBALS['typenow'] ?? '') === 'product';
  $is_category_list = $pagenow === 'edit-tags.php' && ($_GET['taxonomy'] ?? '') === 'product_category';
  if (!$is_product_list && !$is_category_list) return;
?>
  <style>
    .column-enabled {
      width: 3.5rem;
      vertical-align: middle !important;
    }

    .product-toggle {
      width: 1.6rem;
      height: 1.6rem;
      border-radius: 50%;
      border: 2px solid #aaa;
      background: #fff;
      color: #666;
      font-size: 1rem;
      font-weight: 700;
      margin: 0 auto;
      display: flex;
      align-items: center;
      text-align: center;
      line-height: 0;
      cursor: pointer;
      transition: background .15s, color .15s;
    }

    .product-toggle:hover {
      background-color: #ddd;
    }

    .product-toggle--on {
      border-color: #1a7a1a;
      color: #1a7a1a;
    }

    .product-toggle:disabled {
      opacity: .5;
      cursor: default;
    }
  </style>
<?php
});

add_action('admin_footer', function () {
  $pagenow          = $GLOBALS['pagenow'] ?? '';
  $is_product_list  = $pagenow === 'edit.php' && ($GLOBALS['typenow'] ?? '') === 'product';
  $is_category_list = $pagenow === 'edit-tags.php' && ($_GET['taxonomy'] ?? '') === 'product_category';
  if (!$is_product_list && !$is_category_list) return;

  $product_nonce  = wp_create_nonce('toggle_product_enabled');
  $category_nonce = wp_create_nonce('toggle_category_enabled');
?>
  <script>
    jQuery(function($) {
      $(document).on('click', '.product-toggle', function() {
        var $btn    = $(this).prop('disabled', true);
        var post_id = $btn.data('post-id');
        var term_id = $btn.data('term-id');
        var data    = post_id
          ? { action: 'toggle_product_enabled',  nonce: <?= json_encode($product_nonce) ?>,  post_id: post_id }
          : { action: 'toggle_category_enabled', nonce: <?= json_encode($category_nonce) ?>, term_id: term_id };
        $.post(ajaxurl, data, function(res) {
          if (res.success) {
            var on = res.data.enabled;
            $btn.text(on ? '✓' : '').toggleClass('product-toggle--on', on);
          }
          $btn.prop('disabled', false);
        });
      });
    });
  </script>
<?php
});
