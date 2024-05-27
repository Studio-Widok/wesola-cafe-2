<?php // template name: front page
get_header();
get_part('nav');
get_part('front-top');
?>

<div class="rsep"></div>
<div class="content-wrap">
  <div class="content column">
    <div class="text" id="intro">
      <p class="uppercase">Cześć! JEsteśmy Wesoła cafe i od lat poimy cię
        najlepszą kawą jaką tylko uda nam się znaleźć. Ale kawa to nie wszystko.
        tutaj jakiś krótki wstęp lorem ipsum dolor sit amet. Ale najważniejszy
        tu jesteś ty. więc...</p>
    </div>

    <div class="r"></div>
    <?php get_part('bubble', ['text' => 'how do you like your coffee?']) ?>
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
