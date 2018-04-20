<?php
$wpvc_num_views_key = "wpvc_num_views";

function wpvc_get_num_views_meta($post) {
  global $wpvc_num_views_key;

  return get_post_meta($post->ID, $wpvc_num_views_key, true);
}

function wpvc_get_num_views($post) {
  return wpvc_coerce_valid_num_views(wpvc_get_num_views_meta($post));
}

function wpvc_set_num_views($post, $num_views) {
  global $wpvc_num_views_key;

  update_post_meta($post->ID, $wpvc_num_views_key, $num_views);
}

function wpvc_num_views_is_valid($num_views) {
  return isset($num_views) and !empty($num_views) or is_int($num_views);
}

function wpvc_coerce_valid_num_views(&$num_views) {
  if (!wpvc_num_views_is_valid($num_views)) {
    $num_views = 0;
  }

  return $num_views;
}

function wpvc_increment_num_views($post) {
    wpvc_set_num_views($post, wpvc_get_num_views($post) + 1);
}

function wpvc_get_all_num_views() {
  global $wpdb, $wpvc_num_views_key;
  $type = "page";
  $status = "publish";

  return $wpdb->get_results($wpdb->prepare(
    "
      select * from (
        select ID, post_title, meta_value as $wpvc_num_views_key
        from $wpdb->posts post
        left join $wpdb->postmeta postmeta on postmeta.post_id = post.ID
        where postmeta.meta_key = 'wpvc_num_views'
        and post.post_type = %s
        and post.post_status = %s
      ) as a
      
      union all
      
      select * from (
        select ID, post_title, '0'
        from $wpdb->posts post
        where post.post_type = %s
        and post.post_status = %s
        and not exists
        (
          select 1
          from $wpdb->postmeta postmeta
          where post.ID = postmeta.post_id
          and postmeta.meta_key = 'wpvc_num_views'
        )
      ) as b
      
      order by $wpvc_num_views_key desc, post_title asc;
    ",
    $type,
    $status,
    $type,
    $status
  ));
}
