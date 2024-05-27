<?php
if (empty($text))
  return;
?>


<div class="bubble-wrap">
  <div class="bubble">
    <div class="bubble__bg">
      <svg class="bubble__left" viewBox="0.92 0.92 167.87 253">
        <path fill="none" stroke="#000" stroke-width="8.66"
          d="M168.79 185.44l-54.82 0c-96.66,0 -102.43,-56.27 -102.43,-85.12 0,-28.85 34.63,-86.56 157.25,-86.56" />
      </svg>

      <svg class="bubble__center" viewBox="299.18 0.92 794.9 253"
        preserveAspectRatio="none">
        <line stroke="#000" stroke-width="8.66" x1="1094.07" y1="185.44"
          x2="299.18" y2="185.44" />
        <line stroke="#000" stroke-width="8.66" x1="299.18" y1="13.76"
          x2="1094.07" y2="13.76" />
      </svg>
      <svg class="bubble__right" viewBox="1175.1 0.92 346.49 253">
        <path fill="none" stroke="#000" stroke-width="8.66"
          d="M1175.1 185.44l2.22 0 51.15 51.93c1.45,-17.31 9.24,-51.93 28.86,-51.93l187.54 0c59.15,0 73.58,-73.58 53.38,-108.2 -20.2,-34.62 -41.84,-63.48 -132.72,-63.48l-190.43 0" />
      </svg>
    </div>
    <div class="bubble__text"><?= $text ?></div>
  </div>
</div>
