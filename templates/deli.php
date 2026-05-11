<?php // template name: deli

$logo  = get_field('logo');
$intro = get_field('intro');
$info  = get_field('info');

$enabled_terms = array_filter(
  get_terms(['taxonomy' => 'product_category', 'hide_empty' => false]) ?: [],
  fn($term) => get_field('enabled', $term)
);

$all_products = get_posts([
  'post_type'      => 'product',
  'posts_per_page' => -1,
  'post_status'    => 'publish',
  'meta_key'       => 'enabled',
  'meta_value'     => '1',
  'orderby'        => 'menu_order title',
  'order'          => 'ASC',
]);

$categories = [];
foreach ($enabled_terms as $term) {
  $products = array_values(array_filter($all_products, function ($p) use ($term) {
    $terms = get_the_terms($p->ID, 'product_category');
    return !empty($terms) && !is_wp_error($terms) && $terms[0]->term_id === $term->term_id;
  }));
  if (!empty($products)) {
    $categories[] = ['term' => $term, 'products' => $products];
  }
}

get_header();
get_part('nav');
get_part('top');
?>

<div class="content-wrap content-wrap-yellow">
  <div class="rsep"></div>
  <div class="rsep"></div>

  <div class="content column">

    <div class="color-red">
      <?php
      $langs = pll_the_languages(['hide_current' => true, 'raw' => true]);
      if (!empty($langs)) {
        $other      = reset($langs);
        $switchText = $other['slug'] === 'en' ? pll__('Switch to English version') : pll__('Zmień na Polską wersję');
      ?>
        <a href="<?= $other['url'] ?>" class="deli-lang-switch text uppercase">
          <?= $switchText ?>
        </a>
      <?php } ?>
      <?php if (!empty($logo)) { ?>
        <div class="r"></div>
        <div class="deli-logo">
          <?= widok_img($logo, ['srcset' => true]) ?>
        </div>
      <?php } ?>
      <div class="r"></div>
      <div class="text uppercase large" id="intro">
        <?= $intro ?>
      </div>
    </div>

    <div class="rsep"></div>

    <div class="text uppercase"><?= get_field('our_products') ?></div>

    <?php if (!empty($categories)) { ?>
      <div class="r"></div>

      <div class="deli-categories">
        <?php foreach ($categories as $cat) { ?>
          <a href="#category-<?= esc_attr($cat['term']->slug) ?>" class="deli-category-btn">
            <?= esc_html($cat['term']->name) ?>
          </a>
        <?php } ?>
      </div>

      <div class="deli-products">
        <?php foreach ($categories as $cat) {
          $products = $cat['products'];
        ?>
          <div class="deli-category-section" id="category-<?= esc_attr($cat['term']->slug) ?>">
            <div class="r"></div>
            <div class="accent"><?= esc_html($cat['term']->name) ?></div>
            <div class="r"></div>
            <?php for ($i = 0; $i < count($products); $i++) {
              $product     = $products[$i];
              $p_image     = get_field('image', $product->ID);
              $p_decorator = get_field('decorator', $product->ID);
              $p_price     = get_field('price', $product->ID);
              $p_desc      = get_field('description', $product->ID);
              $p_info      = get_field('info', $product->ID);
            ?>
              <div class="product">
                <div class="product__image">
                  <?php if (!empty($p_image)) { ?>
                    <?= widok_img($p_image, ['srcset' => true]) ?>
                  <?php } ?>
                  <?php if (!empty($p_decorator)) { ?>
                    <div class="product__decorator">
                      <?= widok_img($p_decorator) ?>
                    </div>
                  <?php } ?>
                </div>
                <div class="product__content">
                  <div class="product__header">
                    <div class="large uppercase"><?= esc_html(get_the_title($product)) ?></div>
                    <?php if (!empty($p_price)) { ?>
                      <div class="large uppercase"><?= esc_html($p_price) ?></div>
                    <?php } ?>
                  </div>
                  <?php if (!empty($p_desc)) { ?>
                    <div class="text product__description"><?= $p_desc ?></div>
                  <?php } ?>
                  <?php if (!empty($p_info)) { ?>
                    <div class="product__info">
                      <?= $p_info ?>
                    </div>
                  <?php } ?>
                </div>
              </div>
            <?php } ?>
          </div>
        <?php } ?>
      </div>
    <?php } ?>

    <div class="rsep"></div>

  </div>

  <?php if (!empty($info)) { ?>
    <div class="deli-info">
      <?= widok_img($info['image'], ['srcset' => true]) ?>
      <div class="deli-info__text text">
        <?= $info['text'] ?>
      </div>
    </div>
  <?php } ?>
</div>


<?php get_footer(); ?>
