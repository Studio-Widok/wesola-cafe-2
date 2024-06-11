<?php
$privacyPolicyId = get_option('wp_page_for_privacy_policy');
?>

<footer>
  <div class="content-wrap">
    <div class="content column">
      <div class="rsep"></div>
      <img src="<?= get_template_directory_uri() ?>/media/img-footer.svg" alt=""
        id="footer-img">
      <div class="copyright">
        <div><?= get_field('copyright', get_option('page_on_front')) ?></div>
        <div>
          <a href="<?= get_the_permalink($privacyPolicyId) ?>">
            <?= get_the_title($privacyPolicyId) ?>
          </a>
        </div>
      </div>
      <div class="rsep"></div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>

</html>
