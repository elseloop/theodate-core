<?php

// enqueue WP Lit Journal scripts
function theo_admin_load_scripts( $hook ) {

  global $theo_toc_page;

  if( $hook != $theo_toc_page )
    return;

  // plugin stylesheet
  wp_enqueue_style( 'theo-admin-styles', THEO_URL . '/lib/wp-lit-journal/css/admin.css', '', false, 'all' );
  
  // jQuery UI sortable (drag & drop)
  wp_enqueue_script('jquery-ui-sortable');

  /*******************************
  //  issue toc js files
  //  1. switch issue ajax file
  //  2. reorder poems ajax
  //  3. reorder ekphrasis ajax
  ********************************/
  wp_enqueue_script( 'theo-issue-ajax'              , THEO_URL . '/lib/wp-lit-journal/js/theo-issue-ajax.js'              , array( 'jquery' ), null, true );
  wp_enqueue_script( 'theo-issue-poetry-sortable'   , THEO_URL . '/lib/wp-lit-journal/js/theo-issue-poems-sortable.js'    , array( 'jquery' ), null, true );
  wp_enqueue_script( 'theo-issue-ekphrasis-sortable', THEO_URL . '/lib/wp-lit-journal/js/theo-issue-ekphrasis-sortable.js', array( 'jquery' ), null, true );

  // make nonce value available to js
  wp_localize_script( 'theo-issue-ajax', 'theo_issue_vars', array(

      'theo_issue_toc_nonce' => wp_create_nonce( 'theo-issue-toc-nonce' )

    )

  );

}

add_action( 'admin_enqueue_scripts', 'theo_admin_load_scripts' );