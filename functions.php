<?php
// global $env;
// $env = parse_ini_file('.env');

include __DIR__ . '/include/cleanup.php';
include __DIR__ . '/include/enqueue.php';
include __DIR__ . '/include/partials.php';
include __DIR__ . '/include/helpers.php';
include __DIR__ . '/include/getPageId.php';

// if (function_exists('acf_add_options_page')) {
//   acf_add_options_page([
//     'page_title' => 'Theme Options',
//     'position'   => '2.1',
//   ]);
// }

add_filter('use_block_editor_for_post_type', function ($use_block_editor, $post_type) {
  if ('page' === $post_type) {
    return false;
  }
  return $use_block_editor;
}, 10, 2);

// add_filter('wpcf7_autop_or_not', '__return_false');

// function my_acf_init()
// {
//   global $env;
//   acf_update_setting('google_api_key', $env['GOOGLE_API_KEY']);
// }
// add_action('acf/init', 'my_acf_init');

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
