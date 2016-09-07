<?php

add_filter( 'single_template', 'wpbilbao_resumenes_single_template' );
function wpbilbao_resumenes_single_template( $single_template ) {

  $parent     = '20'; //Change to your category ID
  $categories = get_categories( 'child_of=' . $parent );
  $cat_names  = wp_list_pluck( $categories, 'name' );

  if ( has_category( $cat_names ) ) {
      $single_template = get_stylesheet_directory() . '/single/single-cat-resumenes.php';
  }
  return $single_template;

}
