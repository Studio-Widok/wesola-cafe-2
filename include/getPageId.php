<?php
global $customPageStates;
$customPageStates = [
  'catering' => 'Catering',
  'praca'    => 'Praca',
];

/**
 * Register custom settings.
 */
add_action('admin_init', function () {
  global $customPageStates;
  foreach ($customPageStates as $pageStatusKey => $pageStatus) {
    register_setting(
      'reading',
      $pageStatusKey . '_page',
      [
        'type'              => 'string',
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => null,
      ]
    );

    $args = [
      'posts_per_page' => -1,
      'orderby'        => 'name',
      'order'          => 'ASC',
      'post_type'      => 'page',
    ];

    $pages = get_posts($args);
    add_settings_field(
      // ID
      $pageStatusKey . '_page',
      // Title
      $pageStatus . ' Page',
      // Callback
      function ($args) use ($pageStatusKey, $pages) {
        $page_id = intval(get_option($pageStatusKey . '_page'));
        echo '<select id="' . $pageStatusKey . '_page" name="' . $pageStatusKey . '_page">';
        echo '<option value="0">' . '— Select —' . '</option>';
        foreach ($pages as $page) {
          $selected = ($page_id === $page->ID) ? 'selected="selected"' : '';
          echo '<option value="' . $page->ID . '" ' . $selected . '>' . $page->post_title . '</option>';
        }
        echo '</select>';
      },
      // page
      'reading',
      // section
      'default',
      ['label_for' => $pageStatusKey . '_page']
    );
  }
});

/**
 * Add custom state to the page list.
 */
add_filter('display_post_states', function ($states) {
  global $post;
  if ('page' !== get_post_type($post->ID)) {
    return $states;
  }

  if (function_exists('pll_languages_list')) {
    $langs   = pll_languages_list();
    $pageIds = [];
    foreach ($langs as $lang) {
      $pageIds[] = pll_get_post($post->ID, $lang);
    }
  } else {
    $pageIds = [$post->ID];
  }

  global $customPageStates;
  foreach ($customPageStates as $pageStatusKey => $pageStatus) {
    $page_id = intval(get_option($pageStatusKey . '_page'));

    if ($page_id !== 0 && in_array($page_id, $pageIds)) {
      $states[] = $pageStatus;
      break;
    }
  }

  return $states;
});

/**
 * Get page id by pageKey.
 */
function getPageId($pageKey) {
  if (function_exists('pll_get_post')) {
    return pll_get_post(get_option($pageKey . '_page'));
  }
  return get_option($pageKey . '_page');
}
