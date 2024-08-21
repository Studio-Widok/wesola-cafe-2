<?php // template name: menu
get_header();
get_part('nav');
get_part('top');
?>

<div class="rsep rsep--top"></div>

<div class="content-wrap">
  <div class="content column">
    <div class="accent"><?= get_the_title() ?></div>
    <div class="r"></div>
    <div class="flex" id="menu-flex">
      <a href="<?= home_url('menu-pl') . '?t=' . time() ?>" target="_blank"
        rel="noopener noreferrer" class="menu-download">
        <div class="menu-spacer"></div>
        <div class="menu-text">
          <?= get_field('polish', pll_get_post(get_the_ID(), 'pl')) ?>
        </div>
      </a>
      <a href="<?= home_url('menu-en') . '?t=' . time() ?>" target="_blank"
        rel="noopener noreferrer" class="menu-download">
        <div class="menu-spacer"></div>
        <div class="menu-text">
          <?= get_field('english', pll_get_post(get_the_ID(), 'pl')) ?>
        </div>
      </a>
    </div>
  </div>
</div>

<div class="rsep"></div>

<?php get_footer(); ?>
