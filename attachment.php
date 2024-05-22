<?php
if ($post->post_parent) {
  wp_redirect(get_permalink($post->post_parent));
} else {
  wp_redirect(get_home_url());
}
