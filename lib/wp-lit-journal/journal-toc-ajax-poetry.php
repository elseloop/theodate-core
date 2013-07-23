<?php
// WP Lit Journal Issue TOC Admin Page
// process AJAX for poetry post type
function theo_issue_toc_poetry_process_ajax() {
  
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
    
    // get contents of that issue
    $issue_poems  = get_issue_poems( $issue_id, true ); // wp obj

    if( $issue_poems && $issue_poems->have_posts() ) {

      $i=1;

      while( $issue_poems->have_posts() ) {
        $issue_poems->the_post();

        global $post;
        $poem_status = theo_print_status( get_the_id() );

        ?><tr id="theo_poem_item_<?php echo get_the_id(); ?>" class="theo-content-poetry-list theo-content-list">
            <td class="key"><?php echo $post->menu_order; ?></td>
            <td><strong><a href="<?php echo admin_url( 'post.php?post=' . get_the_id() . '&action=edit' ); ?>"><?php echo get_the_title() . " <em>" . $poem_status . "</em>"; ?></a></strong>
                <div class="row-actions">
                  <span class="edit"><a href="<?php echo admin_url( 'post.php?post=' . get_the_id() . '&action=edit' ); ?>">Edit</a></span>
                  &nbsp;|&nbsp;
                  <span class="view"><a href="<?php the_permalink(); ?>">View</a></span>
                </div>
            </td>
            <td><?php

              $poet = get_single_poet( get_the_ID() );
              
              if( $poet && $poet->have_posts() ) {
                while( $poet->have_posts() ) {
                  $poet->the_post();

                  the_title();

                } // endwhile poet

                wp_reset_postdata(); // cleanup poet

              } // endif poet
              
            ?></td>
          </tr><?php  

      $i++;

      } // endwhile poems
    
      wp_reset_postdata(); // cleanup

    } else {

      ?><tr>
          <td class="key">No poems in this issue yet. <a href="<?php echo admin_url( 'post-new.php?post_type=poetry' ); ?>">Add one?</a></td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr><?php

    }// endif poems

    die();

  } 

}

add_action( 'wp_ajax_theo_load_issue_poems', 'theo_issue_toc_poetry_process_ajax' );


// update menu_order for poems in issue
function theo_update_poetry_order() {
  
  $new_poem_order  = $_POST['theo_poem_item'];

  foreach ($new_poem_order as $key => $value) {
    
    wp_update_post(
      array(
        'ID'          =>  $value,
        'menu_order'  =>  $key + 1
      )
    );

  } // endforeach
  
  echo json_encode($new_poem_order);

  die();
}

add_action( 'wp_ajax_theo_update_poetry_order', 'theo_update_poetry_order' );