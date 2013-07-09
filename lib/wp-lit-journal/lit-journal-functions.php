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
    'posts_per_page'  =>  1
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