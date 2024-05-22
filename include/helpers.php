<?php
function join_attribs($attr) {
  $result = '';
  foreach ($attr as $key => $value) {
    if ($value !== '' && empty($value)) {
      continue;
    }

    if (is_array($value)) {
      $result .= " $key=\"" . implode(' ', $value) . "\"";
    } else {
      $result .= " $key=\"$value\"";
    }
  }
  return $result;
}

/**
 * $options [
 *   alt {string}
 *   width {string}
 *   height {string}
 *   class {string|[string]} = []
 *   size {string:imageSize} = 'large'
 *   lazyload {bool} = true
 *   srcset {bool} = false
 *   sizes {string}
 *   attr {['string' => 'string']}
 * ]
 */
function widok_img($imageArray, $options = []) {
  if (empty($imageArray)) {
    return;
  }

  $defaultOptions = [
    'alt'      => $imageArray['alt'],
    'width'    => $imageArray['width'],
    'height'   => $imageArray['height'],
    'class'    => [],
    'id'       => '',
    'size'     => 'large',
    'lazyload' => true,
    'srcset'   => false,
    'sizes'    => '',
  ];

  foreach ($defaultOptions as $key => $value) {
    if (!isset($options[$key])) {
      $options[$key] = $value;
    }
  }

  $attr = [
    'alt'    => $options['alt'],
    'width'  => $options['width'],
    'height' => $options['height'],
    'class'  => $options['class'],
    'id'     => $options['id'],
    'srcset' => $options['srcset'],
    'sizes'  => $options['sizes'],
  ];

  $options['size'] = $options['size'] ?? $defaultOptions['size'];

  if (!empty($options['srcset'])) {
    $attr['srcset'] = wp_get_attachment_image_srcset($imageArray['ID'], $options['size']);
    $attr['src']    = $imageArray['sizes'][$options['size']];
    if (!empty($options['sizes'])) {
      $attr['sizes'] = $options['sizes'];
    }
  } else {
    $attr['src'] = $imageArray['sizes'][$options['size']];
  }

  if ($options['lazyload']) {
    if (is_array($attr['class'])) {
      $attr['class'][] = 'lazyload';
    } else {
      $attr['class'] .= ' lazyload';
    }
    $attr['data-srcset'] = $attr['srcset'];
    unset($attr['srcset']);
    $attr['data-src'] = $attr['src'];
    unset($attr['src']);

    unset($attr['sizes']);
    if (!isset($attr['sizes'])) {
      $attr['data-sizes'] = 'auto';
    }
  }

  if (!empty($options['attr'])) {
    foreach ($options['attr'] as $key => $value) {
      $attr[$key] = $value;
    }
  }

  return '<img ' . join_attribs($attr) . '>';
}
