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
            
            $cur_issue  = get_current_issue_id( $admin = true );
            $cur_status = theo_print_status($cur_issue);

            echo '<option class="current-issue" value="' . $cur_issue . '">' . get_the_title( $cur_issue ) . " " . $cur_status . '</option>';

            $issues = theo_get_filtered_issue_list( $admin = true );

            if ( $issues && ! is_wp_error( $issues ) ) {

                foreach( $issues as $issue ) {

                  $status = theo_print_status($issue->ID);

                  echo '<option class="back-issue" value="' . $issue->ID . '">' . get_the_title( $issue->ID ) . " " . $status . '</option>';
                
                }
              
            } else {
              
              echo '<option value="empty">No issues</option>';

            }
          
          ?></select>

          <input style="margin-left:1em;" type="submit" name="theo-issue-toc-submit" id="theo-issue-toc-submit" class="button-primary" value="<?php _e('Load Issue', 'foundation'); ?>"/>

          <img src="<?php echo admin_url('/images/wpspin_light.gif'); ?>" class="waiting" id="theo-loading" style="display:none;"/>

        </div>
      </form>
      
      <div style="margin-top:1em;" id="theo_issue_toc_poems">
        
        <h2>Poetry</h2>

        <table id="poetry-table" class="wp-list-table widefat fixed posts issue-toc-list">
          
          <thead>
            <tr>
              <th>Order</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </thead>
          
          <tfoot>
            <tr>
              <th>Order</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </tfoot>
          
          <tbody><?php

            // start with the current issue; get id to pass
            $cur_issue_id = get_current_issue_id();
            
            // get contents of that issue
            $issue_poems  = get_issue_poems( $cur_issue_id ); // wp obj

            if( $issue_poems ) {

              $i=1;

              while( $issue_poems->have_posts() ) {
                $issue_poems->the_post();

                global $post;
                $poem_status = theo_print_status( get_the_id() );

                ?><tr id="theo_poem_item_<?php echo get_the_id(); ?>" class="theo-content-poetry-list theo-content-list">
                    <td class="key"><?php echo $post->menu_order; ?></td>
                    <td><strong><a href="<?php echo admin_url( 'post.php?post=' . get_the_id() . '&action=edit' ); ?>"><?php the_title() . " <strong>" . $poem_status . "</strong>"; ?></a></strong>
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

              } // endwhile

              wp_reset_postdata(); // cleanup

            } else {

              ?><tr>
                  <td class="key">No poems in this issue yet. <a href="<?php echo admin_url( 'post-new.php?post_type=poetry' ); ?>">Add one?</a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr><?php

            }// endif poems

          ?></tbody>

        </table>

      </div>

      <div style="margin-top:2em;" id="theo_issue_toc_ekphrasis">
        
        <h2>Ekphrasis</h2>

        <table id="ekphrasis-table" class="wp-list-table widefat fixed posts issue-toc-list">
          
          <thead>
            <tr>
              <th>Order</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </thead>
          
          <tfoot>
            <tr>
              <th>Order</th>
              <th>Title</th>
              <th>Author</th>       
            </tr>
          </tfoot>
          
          <tbody><?php

            // start with the current issue; get id to pass
            $cur_issue_id = get_current_issue_id();
            
            // get contents of that issue
            $issue_ekphrasis  = get_issue_ekphrasis( $cur_issue_id ); // wp obj

            if( $issue_ekphrasis && $issue_ekphrasis->have_posts() ) {

              $i=1;

              while( $issue_ekphrasis->have_posts() ) {
                $issue_ekphrasis->the_post();

                global $post;
                $ekphrasis_status = theo_print_status( get_the_id() );

                ?><tr id="theo_ekphrasis_item_<?php echo get_the_id(); ?>" class="theo-content-ekphrasis-list theo-content-list">
                    <td class="key"><?php echo $post->menu_order; ?></td>
                    <td><strong><a href="<?php echo admin_url( 'post.php?post=' . get_the_id() . '&action=edit' ); ?>"><?php the_title() . " <strong>" . $ekphrasis_status . "</strong>"; ?></a></strong>
                      <div class="row-actions">
                        <span class="edit"><a href="<?php echo admin_url( 'post.php?post=' . get_the_id() . '&action=edit' ); ?>">Edit</a></span>
                        &nbsp;|&nbsp;
                        <span class="view"><a href="<?php the_permalink(); ?>">View</a></span>
                      </div></td>
                    <td><?php

                      $poet = get_single_poet( get_the_ID() );
                      
                      if( $poet && $poet->have_posts() ) {
                        while( $poet->have_posts() ) {
                          $poet->the_post();

                          the_title();

                        } // endwhile poet

                        wp_reset_postdata(); // cleanup poet

                      } else {

                        echo "N/A";

                      }// endif poet
                      
                    ?></td>
                  </tr><?php  

              $i++;

              } // endwhile ekphrasis

              wp_reset_postdata();

            } else {

              ?><tr>
                  <td class="key">No ekphrasis in this issue yet. <a href="<?php echo admin_url( 'post-new.php?post_type=ekphrasis' ); ?>">Add one?</a></td>
                  <td>&nbsp;</td>
                  <td>&nbsp;</td>
                </tr><?php

            }// endif ekphrasis

          ?></tbody>

        </table>

      </div>

  </div><?php

} // end theo_render_admin()