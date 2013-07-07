<?php

/**
  *
  * Lit Journal Functions
  *
  * Helper functions to make organizing content by issue easier
  *
  * @uses Advanced Custom Field's get_field() and similar functions
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

  if ( $issue->have_posts() ) : while ( $issue->have_posts() ) : $issue->have_posts();

    $poems = get_posts(array(
      'post_type' => 'poetry',
      'meta_query' => array(
        array(
          'key' => 'poetry_issue', // name of custom field
          'value' => '"' . $issue_id . '"', // matches exaclty "123", not just 123. This prevents a match for "1234"
          'compare' => 'LIKE'
        )
      )
    ));

    if( $poems ) {

      return $poems;

    }  

  endwhile; wp_reset_postdata(); endif;
  
    
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


// get_poet
// @param $issue_id
function get_single_poet($poem_id) {

  $poem = get_single_poem($poem_id);

  if ( $poem->have_posts() ) : while( $poem->have_posts() ) : $poem->the_post();
    
    $poet = new WP_Query( array(
        
      'post_type' => 'theo_author',
      'meta_query' => array(
        
        array(
          'key'     => 'poetry_author',
          'value'   => '"' . $poem_id . '"',
          'compare' => 'LIKE'
        )

      )

    ));

    if( $poet->have_posts() ) {

      return $poet;

    }

  endwhile; wp_reset_postdata(); endif;

} // get_single_poet