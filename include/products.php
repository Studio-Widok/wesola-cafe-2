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
    . ($on ? '✓' : '–') . '</button>';
}, 10, 2);

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

// ── Admin assets ──────────────────────────────────────────────────────────────

add_action('admin_head', function () {
  if (($GLOBALS['pagenow'] ?? '') !== 'edit.php') return;
  if (($GLOBALS['typenow'] ?? '') !== 'product') return;
  ?>
  <style>
    .column-enabled { width: 4.5rem; text-align: center; }
    .product-toggle {
      width: 2rem; height: 2rem; border-radius: 50%; border: none;
      background: #ddd; color: #666; font-size: 1rem;
      cursor: pointer; transition: background .15s, color .15s;
    }
    .product-toggle--on { background: #1a7a1a; color: #fff; }
    .product-toggle:disabled { opacity: .5; cursor: default; }
  </style>
  <?php
});

add_action('admin_footer', function () {
  if (($GLOBALS['pagenow'] ?? '') !== 'edit.php') return;
  if (($GLOBALS['typenow'] ?? '') !== 'product') return;
  $nonce = wp_create_nonce('toggle_product_enabled');
  ?>
  <script>
    jQuery(function ($) {
      $(document).on('click', '.product-toggle', function () {
        var $btn = $(this).prop('disabled', true);
        $.post(ajaxurl, {
          action:  'toggle_product_enabled',
          nonce:   <?= json_encode($nonce) ?>,
          post_id: $btn.data('post-id'),
        }, function (res) {
          if (res.success) {
            var on = res.data.enabled;
            $btn.text(on ? '✓' : '–').toggleClass('product-toggle--on', on);
          }
          $btn.prop('disabled', false);
        });
      });
    });
  </script>
  <?php
});
