<?php
add_action('init', function () {
  $url = get_template_directory_uri() . '/dist/';
  wp_register_style('widok-main', $url . 'main.css', [], 1.0);
  // wp_register_style('widok-templates', $url . 'templates.css', [], 1.0);
  wp_register_script('widok-main', $url . 'main.js', [], 1.0, true);
});

// add_action('admin_init', function () {
//   $url = get_template_directory_uri() . '/dist/';
// });

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('widok-main');
  wp_enqueue_script('widok-main');
});

// add_action('admin_enqueue_scripts', function () {
//   wp_enqueue_style('widok-templates');
// });
