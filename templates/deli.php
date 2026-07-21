<?php // template name: deli

function getDeliCatName($cat) {
  if (pll_current_language() === 'pl') return esc_html($cat['term']->name);
  return get_field('english_title', $cat['term']);
}

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

      <div class="rsep"></div>

      <div class="text uppercase"><?= get_field('our_products') ?></div>
    </div>

    <?php if (!empty($categories)) { ?>
      <div class="deli-categories-wrap">
        <div class="deli-categories">
          <?php foreach ($categories as $cat) { ?>
            <a href="#category-<?= esc_attr($cat['term']->slug) ?>" class="deli-category-btn">
              <?= getDeliCatName($cat); ?>
            </a>
          <?php } ?>
        </div>
      </div>

      <div class="deli-products">
        <?php foreach ($categories as $cat) {
          $products = $cat['products'];
        ?>
          <div class="deli-category-section" id="category-<?= esc_attr($cat['term']->slug) ?>">
            <div class="r"></div>
            <div class="accent deli-category-header"><?= getDeliCatName($cat) ?></div>
            <div class="r"></div>
            <?php for ($i = 0; $i < count($products); $i++) {
              $product = $products[$i];
              $p_image = get_field('image', $product->ID);
              $p_decorator = get_field('decorator', $product->ID);
              $p_price = get_field('price', $product->ID);

              $useEng = pll_current_language() !== 'pl';
              $p_title = get_the_title($product);
              $p_desc = get_field('description', $product->ID);
              $p_info = get_field('info', $product->ID);
              if ($useEng) {
                $p_title_en = get_field('name_en', $product->ID);
                $p_desc_en = get_field('description_en', $product->ID);
                $p_info_en = get_field('info_en', $product->ID);

                $p_title = empty($p_title_en) ? $p_title : $p_title_en;
                $p_desc = empty($p_desc_en) ? $p_desc : $p_desc_en;
                $p_info = empty($p_info_en) ? $p_info : $p_info_en;
              }
            ?>
              <div class="product">
                <?php if (!empty($p_image)) { ?>
                  <div class="product__image">
                    <?= widok_img($p_image, ['srcset' => true]) ?>
                    <?php if (!empty($p_decorator)) { ?>
                      <div class="product__decorator">
                        <?= widok_img($p_decorator) ?>
                      </div>
                    <?php } ?>
                  </div>
                <?php } ?>
                <div class="product__content">
                  <div class="product__header">
                    <div class="large uppercase"><?= esc_html($p_title) ?></div>
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
