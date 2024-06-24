<?php

include __DIR__ . '/include/cleanup.php';
include __DIR__ . '/include/enqueue.php';
include __DIR__ . '/include/partials.php';
include __DIR__ . '/include/helpers.php';
include __DIR__ . '/include/getPageId.php';

add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
  if ('page' === $post_type) {
    return false;
  }
  return $use_block_editor;
}, 10, 2);

add_action('init', function () {
  register_post_type('work', [
    'public'      => true,
    'label'       => 'Oferty Pracy',
    'labels'      => [
      'singular_name' => 'Oferta Pracy',
    ],
    'has_archive' => false,
    'supports'    => ['title'],
  ]);
});

add_filter('pre_get_document_title', 'custom_page_title', 100, 1);
function custom_page_title($title) {
  if (!is_front_page())
    return $title;

  return get_bloginfo('name');
}

add_action('acf/save_post', 'my_acf_save_post');
function my_acf_save_post($post_id) {
  if (!in_array($post_id, [intval(get_option('page_on_front')), pll_get_post(get_option('page_on_front'), 'en')])) {
    return;
  }

  $eating = get_field('eating', get_option('page_on_front'));
  $url    = str_replace(home_url() . '/', '', $eating['menu_download']['url']);

  $eatingEn = get_field('eating', pll_get_post(get_option('page_on_front'), 'en'));
  $urlEn    = str_replace(home_url() . '/', '', $eatingEn['menu_download']['url']);

  global $wp_rewrite;
  $wp_rewrite->add_external_rule('menu-en\/?', $urlEn);
  $wp_rewrite->add_external_rule('menu-pl\/?', $url);
  flush_rewrite_rules();
}
