<?php
/*
Plugin Name: WP View Counter
description: A plugin that tracks post views and displays the views in the admin dashboard
version: 0.1
Author: Josh Raker
Author URI: https://joshraker.com
License: GPL3
*/

include_once "functions.php";

add_action("wp_head", "wpvc_increment_current_post_num_views");
add_action("wp_dashboard_setup", "wpvc_setup_dashboard");

function wpvc_increment_current_post_num_views() {
  if (is_page()) {
    global $post;

    if ($post->post_status == 'publish') {
      wpvc_increment_num_views($post);
    }
  }
}

function wpvc_setup_dashboard() {
  wp_add_dashboard_widget("wp-view-counter", "WP View Counter", "wpvc_display_dashboard");
}

function wpvc_display_dashboard() {
  include "dashboard.php";
}
