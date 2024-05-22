<?php
function get_part($__file, $__data = []) {
  _get_part('parts', $__file, $__data);
}

function get_component($__file, $__data = []) {
  _get_part('components', $__file, $__data);
}

function get_the_part($__file, $__data = []) {
  ob_start();
  _get_part('parts', $__file, $__data);
  return ob_get_clean();
}

function get_the_component($__file, $__data = []) {
  ob_start();
  _get_part('components', $__file, $__data);
  return ob_get_clean();
}

function _get_part($__folder, $__file, $__data) {
  if (WP_DEBUG) {
    echo "<!-- ";
    echo "part: " . $__file;
    echo " -->";
  }

  $__path = __DIR__ . '/../' . $__folder . '/' . $__file . '.php';
  if (!is_file($__path)) {
    trigger_error('file "' . $__path . '" not found', E_USER_WARNING);
    return;
  }

  $__index = call_user_func(function ($__path) {
    global $displayed_parts;
    if (!isset($displayed_parts)) {
      $displayed_parts = [];
    }

    if (!isset($displayed_parts[$__path])) {
      $displayed_parts[$__path] = 0;
    }

    return $displayed_parts[$__path]++;
  }, $__path);

  foreach ($__data as $__key => &$__value) {
    $$__key = &$__value;
  }

  include $__path;

  if (WP_DEBUG) {
    echo "<!-- ";
    echo "part end: " . $__file;
    echo " -->";
  }

  return $__data;
}
