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
