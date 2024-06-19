<?php
// cSpell:ignore staticize
add_theme_support("title-tag");
add_filter('show_admin_bar', '__return_false');

add_filter('intermediate_image_sizes', function ($sizes) {
  return array_filter($sizes, function ($val) {
    return $val !== 'medium_large';
  });
});

add_action('init', function () {
  wp_deregister_script('wp-embed');
  remove_image_size('1536x1536');
  remove_image_size('2048x2048');
  remove_action('wp_head', 'print_emoji_detection_script', 7);
  remove_action('admin_print_scripts', 'print_emoji_detection_script');
  remove_action('wp_print_styles', 'print_emoji_styles');
  remove_action('admin_print_styles', 'print_emoji_styles');
  remove_filter('the_content_feed', 'wp_staticize_emoji');
  remove_filter('comment_text_rss', 'wp_staticize_emoji');
  remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
  unregister_taxonomy_for_object_type('post_tag', 'post');
  unregister_taxonomy_for_object_type('category', 'post');

  add_image_size('small', 400, 400);
  add_image_size('small-medium', 800, 800);
});

add_filter('auto_plugin_update_send_email', '__return_false');
add_filter('auto_core_update_send_email', function ($_send, $type, $_core_update, $_result) {
  return $type !== 'success';
}, 10, 4);

add_action('wp_default_scripts', function ($scripts) {
  if (!is_admin() && isset($scripts->registered['jquery'])) {
    $script = $scripts->registered['jquery'];
    if ($script->deps) {
      $script->deps = array_diff($script->deps, ['jquery-migrate']);
    }
  }
});

function disable_feed() {
  wp_die();
}

add_action('do_feed_rdf', 'disable_feed', 1);
add_action('do_feed_rss', 'disable_feed', 1);
add_action('do_feed_rss2', 'disable_feed', 1);
add_action('do_feed_atom', 'disable_feed', 1);
add_action('do_feed_rss2_comments', 'disable_feed', 1);
add_action('do_feed_atom_comments', 'disable_feed', 1);
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'feed_links', 2);

add_action('wp_before_admin_bar_render', function () {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('comments');
  $wp_admin_bar->remove_menu('new-content');
});

add_action('admin_menu', function () {
  remove_menu_page('edit.php'); // Posts
  remove_menu_page('edit-comments.php'); // Comments
}, 11);

add_action('wp_enqueue_scripts', function () {
  wp_dequeue_style('wp-block-library');
  wp_dequeue_style('global-styles');
  wp_dequeue_style('safe-svg-svg-icon-style');
  wp_dequeue_style('classic-theme-styles');
  wp_deregister_style('sbi_styles');
  wp_deregister_script('sbi_scripts');
}, 10);

add_action('after_switch_theme', function () {
  update_option('medium_size_w', 1080);
  update_option('medium_size_h', 1080);
  update_option('large_size_w', 1920);
  update_option('large_size_h', 1920);
});

add_filter('max_srcset_image_width', function ($max_width, $size_array) {
  return $size_array[0];
}, 10, 2);

add_filter('site_status_tests', function ($tests) {
  unset($tests['direct']['cookie_compliance_status']);
  return $tests;
});
