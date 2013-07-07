<?php
/**
  *
  * Journal Admin Page
  *
  * sets up a page in WP Admin
  * * registers menu item
  * * outputs page HTML
  * * registers & enqueues javascript files
  *
  * initially has list of all issues
  * AJAXes in contents of selected issue in WP post list table
  * allows drag & drop reordering of contents
  *
  */

// Register menu item
function theo_admin_page() {

  global $theo_toc_page;

  $theo_toc_page = add_submenu_page( 
    'edit.php?post_type=issue',                     // parent menu item
    __( 'Issues Table of Contents', 'foundation' ), // page title (<title> not <h2>)
    __( 'Issues TOC',               'foundation' ), // menu item title
    'manage_options',                               // capabilities
    'issues-toc',                                   // page slug
    'theo_render_admin'                             // callback to render page HTML
  );

} // end theo_admin_page()

add_action( 'admin_menu', 'theo_admin_page' );


// render page
function theo_render_admin() {
  
  ?><div class="wrap">
      
      <h2 style="margin-bottom:1em;"><?php echo get_admin_page_title(); ?></h2>
      
      <form id="theo-issue-toc-form" action="" method="POST">
        <div>
          
          <label for="issues">Select Issue: </label>

          <select name="issues" id="theo-issues-select"><?php
            
            $issues = get_posts(
              array(
                'post_type'       =>  'issue',
                'posts_per_page'  =>  -1
              )
            );
            
            if( $issues ) :

                foreach( $issues as $issue ) {

                  echo '<option value="' . $issue->ID . '">' . get_the_title( $issue->ID ) . '</option>'; 
                
                }
              
            else :
              
              echo '<option value="empty">No issues</option>';

            endif;
          
          ?></select>

          <input style="margin-left:1em;" type="submit" name="theo-issue-toc-submit" id="theo-issue-toc-submit" class="button-primary" value="<?php _e('Load Issue', 'foundation'); ?>"/>

          <img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="waiting" id="theo-loading" style="display:none;"/>

        </div>
      </form>
      
      <div style="margin-top:1em;" id="theo_issue_toc_poems">
        
        <h2>Poetry</h2>

        <table id="poetry-table" class="widefat">
          
          <thead>
            <tr>
              <th>Order No.</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </thead>
          
          <tfoot>
            <tr>
              <th>Order No.</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </tfoot>
          
          <tbody><?php

            $cur_issue_id = get_current_issue_id();
            $issue        = get_single_issue( $cur_issue_id );
            $issue_poems  = get_issue_poems( $cur_issue_id );

            foreach ( $issue_poems as $key => $poem ) {

              ?><tr>
                  <td><?php echo $key + 1; ?></td>
                  <td><?php echo get_the_title( $poem->ID ); ?></td>
                  <td><?php

                    $poet = get_single_poet( $poem->ID );

                    echo "<pre>";
                    print_r($poet);
                    echo "</pre>";

                  ?></td>
                <tr><?php

            }

          ?></tbody>

        </table>

      </div>

      <div style="margin-top:2em;" id="theo_issue_toc_ekphrasis">
        
        <h2>Ekphrasis</h2>

        <table class="widefat">
          
          <thead>
            <tr>
              <th>Title</th>
              <th>Author</th>       
              <th>Order No.</th>
            </tr>
          </thead>
          
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Author</th>       
              <th>Order No.</th>
            </tr>
          </tfoot>
          
          <tbody>
           <tr>
             <td>No posts available</td>
             <td>&nbsp;</td>
             <td>&nbsp;</td>
           </tr>
          </tbody>

        </table>

      </div>

  </div><?php

} // end theo_render_admin()


// enqueue scripts
function theo_admin_load_scripts( $hook ) {

  global $theo_toc_page;

  if( $hook != $theo_toc_page )
    return;

  wp_enqueue_script( 'theo-issue-ajax', THEO_URL . '/lib/wp-lit-journal/js/theo-issue-ajax.js', array( 'jquery' ), null, true );

  wp_localize_script( 'theo-issue-ajax', 'theo_issue_vars', array(

      'theo_issue_toc_nonce' => wp_create_nonce( 'theo-issue-toc-nonce' )

    )

  );

}

add_action( 'admin_enqueue_scripts', 'theo_admin_load_scripts' );


// process ajax

function theo_issue_toc_process_ajax() {
  
  // if the request came from somewhere nasty, bail.
  if( !isset( $_POST[ 'theo_issue_toc_nonce' ] ) || !wp_verify_nonce( $_POST[ 'theo_issue_toc_nonce' ], 'theo-issue-toc-nonce' ) ) {
    
    die( 'You do not have permission to perform this action.' );  
  
  }

  // get the id of the selected issue
  $issue_id = $_POST[ 'issue_id' ];

  // if there aren't any issues, tell 'em and bail
  if ( 'empty' == $issue_id ) {
    
    die( 'You haven&rsquo;t created any issues yet.' );
  
  } else { 
    
    // load up on poems
    $issue_poems  = get_issue_poems( $issue_id );

    foreach ( $issue_poems as $key => $value ) {
      
      $poem_id  = $value->ID;

      ?><tr>
          <td><?php echo $key + 1; ?></td>
          <td><?php echo get_the_title( $value->ID ); ?></td>
          <td><?php
            
            $poet = get_single_poet($poem_id);
      
            echo "<pre>";
            print_r($poet);
            echo "</pre>";
            
          ?></td>
          
        <tr><?php

    }

    die();

  } 

}

add_action( 'wp_ajax_theo_load_issue', 'theo_issue_toc_process_ajax' );
