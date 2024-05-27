<?php // template name: front page

$intro = get_field('intro');

get_header();
get_part('nav');
get_part('front-top');
?>

<div class="rsep"></div>
<div class="content-wrap">
  <div class="content column">
    <div class="text uppercase" id="intro">
      <?= $intro['text'] ?>
    </div>

    <div class="r"></div>

    <div class="flex bubble-sketch">
      <?php get_part('bubble', ['text' => 'how do you like your coffee?']) ?>
      <img src="<?= get_template_directory_uri() ?>/media/img-1.png" alt="">
    </div>

    <?php get_part('image-group', ['images' => $intro['images']]) ?>

    <div class="r"></div>

    <div class="text"><?= $intro['text_2'] ?></div>



    <div class="r"></div>
    <?php get_part('bubble', ['text' => 'Lorem ipsum']) ?>
    <div class="r"></div>
    <?php get_part('bubble', ['text' => 'Lorem ipsum dolor, sit amet consectetur adipisicing.']) ?>
    <div class="r"></div>
    <?php get_part('bubble', ['text' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Assumenda sit vitae eveniet sint dolorum doloremque.']) ?>

  </div>
</div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>
<div class="rsep"></div>

<?php get_footer(); ?>
