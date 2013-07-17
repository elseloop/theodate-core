<?php

/**
  *
  * Lit Journal Functions
  *
  * Helper functions to make organizing content by issue easier
  *
  *
  */

/**
  * get current issue
  * get suggested poems
  * get poet
  * get poet meta
  * get issue meta
  * get poem meta
  */



// get current issue id
function get_current_issue_id() {

  $args = array(
    'post_type'       =>  'issue',
    'fields'          =>  'ids',
    'posts_per_page'  =>  1,
    'orderby'         =>  'meta_value id',
    'meta_key'        =>  'issue_is_current_issue',
    'meta_value'      =>  '1'
  );

  $issue  = new WP_Query( $args );

  return $issue->posts[0];

  wp_reset_postdata();

} // get_current_issue_id


// get single issue
function get_single_issue( $id = '' ) {

  $args = array(
    'post_type'       =>  'issue',
    'posts_per_page'  =>  1,
    'page_id'         =>  $id
  );

  $issue  = new WP_Query( $args );

  if($issue) {
    return $issue;
  } else {
    return false;
  }

  wp_reset_postdata();

} // get_single_issue



// get issue poems
// @param $issue_id
function get_issue_poems($issue_id) {

  $issue  = get_single_issue( $issue_id );

  if ( $issue->have_posts() ) { 
    while ( $issue->have_posts() ) {
      $issue->have_posts();

      // Find connected poems
      $issue_poems = new WP_Query( array(
        'connected_type'  => 'poem_to_issue',
        'connected_items' => $issue->get_queried_object(),
        'nopaging'        => true,
        'orderby'         =>  'menu_order',
        'order'           =>  'asc'
      ) );

      if( $issue_poems->have_posts() ) {

        return $issue_poems;

      } else {

        return false;
      
      }

    } // endwhile

    wp_reset_postdata(); // cleanup

  } // endif
    
} // get_issue_poems



// get issue ekphrasis
// @param $issue_id
function get_issue_ekphrasis($issue_id) {

  $issue  = get_single_issue( $issue_id );

  if ( $issue->have_posts() ) { 
    while ( $issue->have_posts() ) {
      $issue->have_posts();

      // Find connected poems
      $issue_poems = new WP_Query( array(
        'connected_type'  => 'ekphrasis_to_issue',
        'connected_items' => $issue->get_queried_object(),
        'nopaging'        => true,
        'orderby'         =>  'menu_order',
        'order'           =>  'asc'
      ) );

      if( $issue_poems->have_posts() ) {

        return $issue_poems;

      } else {

        return false;
      
      }

    } // endwhile

    wp_reset_postdata(); // cleanup

  } // endif
    
} // get_issue_poems



// get_single_poem
// @param $id
function get_single_poem($id) {

  $args = array(
    'post_type'       =>  'poetry',
    'posts_per_page'  =>  1,
    'p'               =>  $id
  );

  $poem  = new WP_Query( $args );

  if($poem) {
    return $poem;
  } else {
    return false;
  }

} // get_single_poem


// get_single_ekphrasis
// @param $id
function get_single_ekphrasis($id) {

  $args = array(
    'post_type'       =>  'ekphrasis',
    'posts_per_page'  =>  1,
    'p'               =>  $id
  );

  $ekphrasis  = new WP_Query( $args );

  if($ekphrasis) {
    return $ekphrasis;
  } else {
    return false;
  }

} // get_single_ekphrasis


// get_poet
// @param $issue_id
function get_single_poet($poem_id) {

  $poem_type  = get_post_type($poem_id);
  
  if ( "poetry" == $poem_type ) {
    $poem       = get_single_poem($poem_id);
  } else {
    // if ekphrasis
    $poem       = get_single_ekphrasis($poem_id);
  }

  if ( $poem->have_posts() ) {
    while( $poem->have_posts() ) {
      $poem->the_post();
    
      $poet = new WP_Query( array(
        'connected_type' => 'poem_to_poet',
        'connected_items' => $poem->get_queried_object(),
        'nopaging' => true,
      ) );

      if( $poet->have_posts() ) {

        return $poet;

      } else {

        return false;

      } // if poet

    } // endwhile

    wp_reset_postdata(); // cleanup

  } // endif

} // get_single_poet


// get issue meta
// returns array of meta data
function theo_get_issue_meta( $id = 0 ) {

  if ( function_exists('get_field') ) {

    $issue_cover          = get_field( 'issue_cover_image', $id );
    $issue_volume         = get_field( 'issue_volume_number', $id );
    $issue_number         = get_field( 'issue_number', $id );
    $issue_date           = get_field( 'issue_publication_date_description', $id );
    $issue_cover_credits  = get_field( 'issue_cover_image_credits', $id );
    $issue_home_desc      = get_field( 'issue_homepage_description', $id );

    $meta_check           = array(
      $issue_cover,
      $issue_volume,
      $issue_number,
      $issue_date,
      $issue_cover_credits,
      $issue_home_desc
    );

    foreach ( $meta_check as $meta ) {
    
      if ( ! empty ( $meta ) ) {
        $meta = $meta;
      } else {
        $meta = false; // give something to test against
      }
      
    } // endforeach $meta_check

    $issue_meta = array(

      'cover'           =>  $issue_cover,
      'volume'          =>  $issue_volume,
      'number'          =>  $issue_number,
      'vol_no'          =>  $issue_volume . '.' . $issue_number,
      'date'            =>  $issue_date,
      'cover_credits'   =>  $issue_cover_credits,
      'home_desc'       =>  $issue_home_desc

    );

    return $issue_meta;

  } // endif function_exists(get_field)

} // end theo_get_issue_meta