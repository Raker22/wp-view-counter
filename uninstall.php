<?php
if (!defined("WP_UNINSTALL_PLUGIN")) {
  exit;
}

global $wpdb;
$wpvc_num_views_key = "wpvc_num_views";

//$wpdb->query($wpdb->prepare("
//  delete from $wpdb->postmeta
//  where meta_key = %s;
//", $wpvc_num_views_key););

$wpdb->delete($wpdb->postmeta, array(
  "meta_key" => $wpvc_num_views_key
));
