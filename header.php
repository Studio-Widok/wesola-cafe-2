<?php
$url = get_template_directory_uri();
if (is_front_page()) {
  $ogtitle = get_bloginfo('name');
} else {
  $ogtitle = get_the_title();
}
// $description = "";
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <!-- <link rel="icon" type="image/png" href="<?= $url ?>/media/favicon.png" /> -->
  <meta property="og:title" content="<?= $ogtitle ?>" />
  <!-- <meta property="og:description" content="<?= $description ?>" /> -->
  <meta property="og:type" content="website" />
  <!-- <meta property="og:image" content="<?= $url ?>/media/ogimg.jpg" /> -->
  <!-- <meta property="og:image:width" content="1200" /> -->
  <!-- <meta property="og:image:height" content="630" /> -->
  <meta property="og:url" content="<?= wp_get_canonical_url() ?>" />
  <meta name="twitter:title" content="<?= $ogtitle ?>" />
  <!-- <meta name="twitter:description" content="<?= $description ?>" /> -->
  <!-- <meta name="twitter:card" content="summary_large_image" /> -->
  <!-- <meta name="twitter:image" content="<?= $url ?>/media/ogimg.jpg" /> -->
  <!-- <meta name="description" content="<?= $description ?>" /> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="color-scheme" content="light only">
  <script>
    const TEMPLATE_DIRECTORY_URI = '<?= $url ?>';
  </script>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
