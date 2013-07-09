<?php
/**
 *
 * 	Setup Post Types
 *
 * 	Registers the Issue, Poetry, Author, and Ekphrasis post types.
 *	Labels and supports are filterable.
 *	Filters use a theo_POSTTYPE_labels and theo_POSTTYPE_supports naming structure.
 *	See Get Default Lable below for more options.
 *
*/

function theo_setup_theo_post_types() {

	/*	=ISSUES POST TYPE
	-----------------------------------*/
	
	/* DEAL WITH THIS MESS LATER */
	$issue_archives = true;
	// Check to see if archives have been disabled elsewhere via constant
	if ( defined( 'THEO_DISABLE_ISSUE_ARCHIVE' ) && THEO_DISABLE_ISSUE_ARCHIVE == true ) {
		$issue_archives = false;
	}
	
	$issue_slug = 'issue';
	// Check to see if slug has been redefined elsewhere via constant
	if ( defined( 'THEO_ISSUE_SLUG' ) ) {
		$issue_slug = THEO_ISSUE_SLUG;
	}
	
	$issue_rewrite = array( 'slug' => $issue_slug, 'with_front' => false );
	if ( defined( 'THEO_DISABLE_ISSUE_REWRITE' ) && THEO_DISABLE_ISSUE_REWRITE == true ) {
		$issue_rewrite = false;
	}
	/* DEAL WITH THE ABOVE MESS LATER */
	
	$issue_labels =  apply_filters( 'theo_issue_labels', array(
		'name' => '%2$s',
		'singular_name' => '%1$s',
		'add_new' => __('Add New', 'theo'),
		'add_new_item' => __('Add New %1$s', 'theo'),
		'edit_item' => __('Edit %1$s', 'theo'),
		'new_item' => __('New %1$s', 'theo'),
		'all_items' => __('All %2$s', 'theo'),
		'view_item' => __('View %1$s', 'theo'),
		'search_items' => __('Search %2$s', 'theo'),
		'not_found' =>  __('No %2$s found', 'theo'),
		'not_found_in_trash' => __('No %2$s found in Trash', 'theo'), 
		'parent_item_colon' => '',
		'menu_name' => __('%3$s', 'theo')
	) );
	
	foreach ( $issue_labels as $key => $value) {
	   $issue_labels[$key] = sprintf( $value, theo_get_issue_label_singular(), theo_get_issue_label_plural(), theo_get_issue_label_menu() );
	}
	
	$issue_args = array(
		'labels' => $issue_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => $issue_rewrite,
		'capability_type' => 'post',
		'has_archive' => $issue_archives, 
		'hierarchical' => false,
		'supports' => apply_filters( 'theo_issue_supports', array( 'title', 'editor', 'thumbnail' ) ),
	); 
	register_post_type( 'issue', $issue_args );
	
	
	
	/*	=POETRY POST TYPE
	-----------------------------------*/
	
	/* DEAL WITH THIS MESS LATER */
	$poetry_archives = true;
	// Check to see if archives have been disabled elsewhere via constant
	if ( defined( 'THEO_DISABLE_POETRY_ARCHIVE' ) && THEO_DISABLE_POETRY_ARCHIVE == true ) {
		$poetry_archives = false;
	}
	
	$poetry_slug = 'poetry';
	// Check to see if slug has been redefined elsewhere via constant
	if ( defined( 'THEO_POETRY_SLUG' ) ) {
		$poetry_slug = THEO_POETRY_SLUG;
	}
	
	$poetry_rewrite = array( 'slug' => $poetry_slug, 'with_front' => false );
	if ( defined( 'THEO_DISABLE_POETRY_REWRITE' ) && THEO_DISABLE_POETRY_REWRITE == true ) {
		$poetry_rewrite = false;
	}
	/* DEAL WITH THE ABOVE MESS LATER */
	
	
	$poetry_labels =  apply_filters( 'theo_poetry_labels', array(
		'name' => '%2$s',
		'singular_name' => '%1$s',
		'add_new' => __('Add New', 'theo'),
		'add_new_item' => __('Add New %1$s', 'theo'),
		'edit_item' => __('Edit %1$s', 'theo'),
		'new_item' => __('New %1$s', 'theo'),
		'all_items' => __('All %2$s', 'theo'),
		'view_item' => __('View %1$s', 'theo'),
		'search_items' => __('Search %2$s', 'theo'),
		'not_found' =>  __('No %2$s found', 'theo'),
		'not_found_in_trash' => __('No %2$s found in Trash', 'theo'), 
		'parent_item_colon' => '',
		'menu_name' => __('%3$s', 'theo')
	) );
	
	foreach ( $poetry_labels as $key => $value) {
	   $poetry_labels[$key] = sprintf( $value, theo_get_poetry_label_singular(), theo_get_poetry_label_plural(), theo_get_poetry_label_menu() );
	}
	
	$poetry_args = array(
		'labels' => $poetry_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => $poetry_rewrite,
		'capability_type' => 'post',
		'has_archive' => $poetry_archives, 
		'hierarchical' => true,
		'supports' => apply_filters( 'theo_poetry_supports', array( 'title', 'editor', 'thumbnail', 'page-attributes' ) ),
	); 
	register_post_type( 'poetry', $poetry_args );
	
	
	
	
	/*	=AUTHOR POST TYPE
	-----------------------------------*/
	
	/* DEAL WITH THIS MESS LATER */
	$theo_author_archives = true;
	// Check to see if archives have been disabled elsewhere via constant
	if ( defined( 'THEO_DISABLE_AUTHOR_ARCHIVE' ) && THEO_DISABLE_AUTHOR_ARCHIVE == true ) {
		$theo_authorarchives = false;
	}
	
	$theo_author_slug = 'authors';
	// Check to see if slug has been redefined elsewhere via constant
	if ( defined( 'THEO_AUTHOR_SLUG' ) ) {
		$theo_author_slug = THEO_AUTHOR_SLUG;
	}
	
	$theo_author_rewrite = array( 'slug' => $theo_author_slug, 'with_front' => false );
	if ( defined( 'THEO_DISABLE_AUTHOR_REWRITE' ) && THEO_DISABLE_AUTHOR_REWRITE == true ) {
		$theo_author_rewrite = false;
	}
	/* DEAL WITH THE ABOVE MESS LATER */
	
	
	$theo_author_labels =  apply_filters( 'theo_author_labels', array(
		'name' => '%2$s',
		'singular_name' => '%1$s',
		'add_new' => __('Add New', 'theo'),
		'add_new_item' => __('Add New %1$s', 'theo'),
		'edit_item' => __('Edit %1$s', 'theo'),
		'new_item' => __('New %1$s', 'theo'),
		'all_items' => __('All %2$s', 'theo'),
		'view_item' => __('View %1$s', 'theo'),
		'search_items' => __('Search %2$s', 'theo'),
		'not_found' =>  __('No %2$s found', 'theo'),
		'not_found_in_trash' => __('No %2$s found in Trash', 'theo'), 
		'parent_item_colon' => '',
		'menu_name' => __('%3$s', 'theo')
	) );
	
	foreach ( $theo_author_labels as $key => $value) {
	   $theo_author_labels[$key] = sprintf( $value, theo_get_author_label_singular(), theo_get_author_label_plural(), theo_get_author_label_menu() );
	}
	
	$theo_author_args = array(
		'labels' => $theo_author_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => $theo_author_rewrite,
		'capability_type' => 'post',
		'has_archive' => $theo_author_archives, 
		'hierarchical' => false,
		'supports' => apply_filters( 'theo_author_supports', array( 'title', 'editor', 'thumbnail' ) ),
	); 
	register_post_type( 'theo_author', $theo_author_args );
	
	
	
	/*	=EKPHRASIS POST TYPE
	-----------------------------------*/
	
	/* DEAL WITH THIS MESS LATER */
	$ekphrasis_archives = true;
	// Check to see if archives have been disabled elsewhere via constant
	if ( defined( 'THEO_DISABLE_ekphrasis_ARCHIVE' ) && THEO_DISABLE_ekphrasis_ARCHIVE == true ) {
		$ekphrasis_archives = false;
	}
	
	$ekphrasis_slug = 'interviews';
	// Check to see if slug has been redefined elsewhere via constant
	if ( defined( 'theo_ekphrasis_SLUG' ) ) {
		$ekphrasis_slug = theo_ekphrasis_SLUG;
	}
	
	$ekphrasis_rewrite = array( 'slug' => $ekphrasis_slug, 'with_front' => false );
	if ( defined( 'THEO_DISABLE_ekphrasis_REWRITE' ) && THEO_DISABLE_ekphrasis_REWRITE == true ) {
		$ekphrasis_rewrite = false;
	}
	/* DEAL WITH THE ABOVE MESS LATER */
	
	
	$ekphrasis_labels =  apply_filters( 'theo_ekphrasis_labels', array(
		'name' => '%2$s',
		'singular_name' => '%1$s',
		'add_new' => __('Add New', 'theo'),
		'add_new_item' => __('Add New %1$s', 'theo'),
		'edit_item' => __('Edit %1$s', 'theo'),
		'new_item' => __('New %1$s', 'theo'),
		'all_items' => __('All %2$s', 'theo'),
		'view_item' => __('View %1$s', 'theo'),
		'search_items' => __('Search %2$s', 'theo'),
		'not_found' =>  __('No %2$s found', 'theo'),
		'not_found_in_trash' => __('No %2$s found in Trash', 'theo'), 
		'parent_item_colon' => '',
		'menu_name' => __('%3$s', 'theo')
	) );
	
	foreach ( $ekphrasis_labels as $key => $value) {
	   $ekphrasis_labels[$key] = sprintf( $value, theo_get_ekphrasis_label_singular(), theo_get_ekphrasis_label_plural(), theo_get_ekphrasis_label_menu() );
	}
	
	$ekphrasis_args = array(
		'labels' => $ekphrasis_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'show_in_menu' => true, 
		'query_var' => true,
		'rewrite' => $ekphrasis_rewrite,
		'capability_type' => 'post',
		'has_archive' => $ekphrasis_archives, 
		'hierarchical' => true,
		'supports' => apply_filters( 'theo_ekphrasis_supports', array( 'title', 'editor', 'thumbnail', 'page-attributes' ) ),
	); 
	register_post_type( 'ekphrasis', $ekphrasis_args );
	
}
	
add_action( 'init', 'theo_setup_theo_post_types', 100 );


/**
 * Get Default Label
 *
 * @access      public
 * @since       0.1
 * @param				none
 * @return      array
 *
 *	To change the default labels for one of the post types, 
 *	write a function that mimics those below
 *	and pass it through the appropraite add_filter call.
 *	For instance, to change the Author/Authors labels to Poet/Poets:
 *
 *	function my_new_default_author_labels() {
 *
 *  	$defaults	=	array(
 *  		'singular'	=>	'Poet',
 *  		'plural'		=>	'Poets',
 *			'menu'			=>	'Poets'
 *  	);
 *  
 *  	return $defaults;
 *
 *	}
 *
 *	add_filter( 'theo_default_author_name', 'my_new_default_author_labels' );
 *
 *	Some Reading: 
 *	
 *	WordPress Codex:		http://codex.wordpress.org/Plugin_API#Hooks.2C_Actions_and_Filters
 *	Smashing Magazine: 	http://wp.smashingmagazine.com/2011/10/07/definitive-guide-wordpress-hooks/
 *	WP Tuts+: 					http://wp.tutsplus.com/tutorials/the-beginners-guide-to-wordpress-actions-and-filters/
 *
 *
*/

function theo_get_default_issue_labels() {

	$defaults = array(
   'singular' => __( 'Issue','theo' ),
   'plural' 	=> __( 'Issues','theo' ),
   'menu'			=> __( 'Issues', 'theo' )
  );
	
	return apply_filters( 'theo_default_issues_name', $defaults );

}

function theo_get_default_poetry_labels() {

	$defaults = array(
	 'singular' => __( 'Poem','theo' ),
	 'plural' 	=> __( 'Poems','theo' ),
	 'menu'			=> __( 'Poetry', 'theo' )
  );
	
	return apply_filters( 'theo_default_poetry_name', $defaults );

}

function theo_get_default_author_labels() {

	$defaults = array(
   'singular' => __( 'Poet','theo' ),
   'plural' 	=> __( 'Poets','theo' ),
   'menu'			=> __( 'Poets', 'theo' )
  );
	
	return apply_filters( 'theo_default_author_name', $defaults );

}

function theo_get_default_ekphrasis_labels() {

	$defaults = array(
   'singular' => __( 'Ekphrasis','theo' ),
   'plural' 	=> __( 'Ekphrasis','theo' ),
   'menu'			=> __( 'Ekphrasis', 'theo' )
  );
	
	return apply_filters( 'theo_default_ekphrasis_name', $defaults );

}


/**
 * Get Label Singular
 *
 * @access      public
 * @since       1.0.8.3
 * @return      string
*/ 

function theo_get_issue_label_singular( $lowercase = false ) {
	$defaults = theo_get_default_issue_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

function theo_get_poetry_label_singular( $lowercase = false ) {
	$defaults = theo_get_default_poetry_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

function theo_get_author_label_singular( $lowercase = false ) {
	$defaults = theo_get_default_author_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}

function theo_get_ekphrasis_label_singular( $lowercase = false ) {
	$defaults = theo_get_default_ekphrasis_labels();
	return ($lowercase) ? strtolower( $defaults['singular'] ) : $defaults['singular'];
}


/**
 * Get Label Plural
 *
 * @access      public
 * @since       1.0.8.3
 * @return      string
*/

function theo_get_issue_label_plural( $lowercase = false ) {
	$defaults = theo_get_default_issue_labels();
	return ($lowercase) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

function theo_get_poetry_label_plural( $lowercase = false ) {
	$defaults = theo_get_default_poetry_labels();
	return ($lowercase) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

function theo_get_author_label_plural( $lowercase = false ) {
	$defaults = theo_get_default_author_labels();
	return ($lowercase) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}

function theo_get_ekphrasis_label_plural( $lowercase = false ) {
	$defaults = theo_get_default_ekphrasis_labels();
	return ($lowercase) ? strtolower( $defaults['plural'] ) : $defaults['plural'];
}



/**
 * Get Label Menu
 *
 * @access      public
 * @since       1.0.8.3
 * @return      string
*/

function theo_get_issue_label_menu( $lowercase = false ) {
	$defaults = theo_get_default_issue_labels();
	return ($lowercase) ? strtolower( $defaults['menu'] ) : $defaults['menu'];
}

function theo_get_poetry_label_menu( $lowercase = false ) {
	$defaults = theo_get_default_poetry_labels();
	return ($lowercase) ? strtolower( $defaults['menu'] ) : $defaults['menu'];
}

function theo_get_author_label_menu( $lowercase = false ) {
	$defaults = theo_get_default_author_labels();
	return ($lowercase) ? strtolower( $defaults['menu'] ) : $defaults['menu'];
}

function theo_get_ekphrasis_label_menu( $lowercase = false ) {
	$defaults = theo_get_default_ekphrasis_labels();
	return ($lowercase) ? strtolower( $defaults['menu'] ) : $defaults['menu'];
}

/**
 * Updated Messages
 *
 * Returns an array of with all updated messages.
 *
 * @access      public
 * @since       1.0 
 * @return      array
*/

function theo_updated_messages( $messages ) {

	global $post, $post_ID;
	
	$singular_issue				=	theo_get_issue_label_singular();
  $singular_poetry			=	theo_get_poetry_label_singular();
  $singular_author			=	theo_get_author_label_singular();
  $singular_ekphrasis		=	theo_get_ekphrasis_label_singular();
	
	$messages['issue'] = array(
		1 => __( $singular_issue . ' updated.', 'theo' ),
		4 => __( $singular_issue . ' updated.', 'theo' ),
		6 => __( $singular_issue . ' published.', 'theo' ),
		7 => __( $singular_issue . ' saved.', 'theo' ),
		8 => __( $singular_issue . ' submitted.', 'theo'),
	);
	
	$messages['poetry'] = array(
		1 => __( $singular_poetry . ' updated.', 'theo' ),
		4 => __( $singular_poetry . ' updated.', 'theo' ),
		6 => __( $singular_poetry . ' published.', 'theo' ),
		7 => __( $singular_poetry . ' saved.', 'theo' ),
		8 => __( $singular_poetry . ' submitted.', 'theo'),
	);
	
	$messages['theo_author'] = array(
		1 => __( $singular_author . ' updated.', 'theo' ),
		4 => __( $singular_author . ' updated.', 'theo' ),
		6 => __( $singular_author . ' published.', 'theo' ),
		7 => __( $singular_author . ' saved.', 'theo' ),
		8 => __( $singular_author . ' submitted.', 'theo'),
	);
	
	$messages['ekphrasis'] = array(
		1 => __( $singular_ekphrasis . ' updated.', 'theo' ),
		4 => __( $singular_ekphrasis . ' updated.', 'theo' ),
		6 => __( $singular_ekphrasis . ' published.', 'theo' ),
		7 => __( $singular_ekphrasis . ' saved.', 'theo' ),
		8 => __( $singular_ekphrasis . ' submitted.', 'theo'),
	);

	return $messages;
	
}

add_filter( 'post_updated_messages', 'theo_updated_messages' );


/**
 * Add Count
 *
 * Echoes count of post type to "Right Now" dashboard widget.
 *
 * @access      public
 * @since       1.0 
 * @return      html
*/


/**
	*	Issues
	*/

function theo_add_issue_count() {
        
        if ( ! post_type_exists( 'issue' ) ) {
	      	return;
	      }
	      
	      $singular		=	theo_get_issue_label_singular();
	      $plural			=	theo_get_issue_label_plural();
      	$num_posts 	= wp_count_posts( 'issue' );
        $num 				= number_format_i18n( $num_posts->publish );
        $text 			= _n( $singular, $plural, intval( $num_posts->publish ), 'theo' );
        
        if ( current_user_can( 'edit_posts' ) ) {
            $num 	= "<a href='edit.php?post_type=issue'>$num</a>";
            $text = "<a href='edit.php?post_type=issue'>$text</a>";
        }
        echo '<td class="first b b-issue">' . $num . '</td>';
        echo '<td class="t issue">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            
					$num 	=	number_format_i18n( $num_posts->pending );
					$text = _n( $singular . ' Pending', $plural . ' Pending', intval( $num_posts->pending ), 'theo' );
					
					if ( current_user_can( 'edit_posts' ) ) {
				    $num	= "<a href='edit.php?post_status=pending&post_type=issue'>$num</a>";
				    $text = "<a href='edit.php?post_status=pending&post_type=issue'>$text</a>";
					}
					echo '<td class="first b b-issue">' . $num . '</td>';
					echo '<td class="t issue">' . $text . '</td>';
					
					echo '</tr>';
					
        }
        
	}

add_action( 'right_now_content_table_end', 'theo_add_issue_count' );



/**
	*	Poetry
	*/
	
function theo_add_poetry_count() {
        
        if ( ! post_type_exists( 'poetry' ) ) {
	      	return;
	      }
	      
	      $singular		=	theo_get_poetry_label_singular();
	      $plural			=	theo_get_poetry_label_plural();
      	$num_posts 	= wp_count_posts( 'poetry' );
        $num 				= number_format_i18n( $num_posts->publish );
        $text 			= _n( $singular, $plural, intval( $num_posts->publish ), 'theo' );
        
        if ( current_user_can( 'edit_posts' ) ) {
            $num 	= "<a href='edit.php?post_type=poetry'>$num</a>";
            $text = "<a href='edit.php?post_type=poetry'>$text</a>";
        }
        echo '<td class="first b b-poetry">' . $num . '</td>';
        echo '<td class="t poetry">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            
					$num 	=	number_format_i18n( $num_posts->pending );
					$text = _n( $singular . ' Pending', $plural . ' Pending', intval( $num_posts->pending ), 'theo' );
					
					if ( current_user_can( 'edit_posts' ) ) {
				    $num	= "<a href='edit.php?post_status=pending&post_type=poetry'>$num</a>";
				    $text = "<a href='edit.php?post_status=pending&post_type=poetry'>$text</a>";
					}
					echo '<td class="first b b-poetry">' . $num . '</td>';
					echo '<td class="t poetry">' . $text . '</td>';
					
					echo '</tr>';
					
        }
        
	}

add_action( 'right_now_content_table_end', 'theo_add_poetry_count' );



/**
	*	Authors
	*/
	
function theo_add_author_count() {
        
        if ( ! post_type_exists( 'theo_author' ) ) {
	      	return;
	      }
	      
	      $singular		=	theo_get_author_label_singular();
	      $plural			=	theo_get_author_label_plural();
      	$num_posts 	= wp_count_posts( 'theo_author' );
        $num 				= number_format_i18n( $num_posts->publish );
        $text 			= _n( $singular, $plural, intval( $num_posts->publish ), 'theo' );
        
        if ( current_user_can( 'edit_posts' ) ) {
            $num 	= "<a href='edit.php?post_type=theo_author'>$num</a>";
            $text = "<a href='edit.php?post_type=theo_author'>$text</a>";
        }
        echo '<td class="first b b-theo_author">' . $num . '</td>';
        echo '<td class="t theo_author">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            
					$num 	=	number_format_i18n( $num_posts->pending );
					$text = _n( $singular . ' Pending', $plural . ' Pending', intval( $num_posts->pending ), 'theo' );
					
					if ( current_user_can( 'edit_posts' ) ) {
				    $num	= "<a href='edit.php?post_status=pending&post_type=theo_author'>$num</a>";
				    $text = "<a href='edit.php?post_status=pending&post_type=theo_author'>$text</a>";
					}
					echo '<td class="first b b-theo_author">' . $num . '</td>';
					echo '<td class="t theo_author">' . $text . '</td>';
					
					echo '</tr>';
					
        }
        
	}

add_action( 'right_now_content_table_end', 'theo_add_author_count' );



/**
	*	Ekphrasis
	*/
	
function theo_add_ekphrasis_count() {
        
        if ( ! post_type_exists( 'ekphrasis' ) ) {
	      	return;
	      }
	      
	      $singular		=	theo_get_ekphrasis_label_singular();
	      $plural			=	theo_get_ekphrasis_label_plural();
      	$num_posts 	= wp_count_posts( 'ekphrasis' );
        $num 				= number_format_i18n( $num_posts->publish );
        $text 			= _n( $singular, $plural, intval( $num_posts->publish ), 'theo' );
        
        if ( current_user_can( 'edit_posts' ) ) {
            $num 	= "<a href='edit.php?post_type=ekphrasis'>$num</a>";
            $text = "<a href='edit.php?post_type=ekphrasis'>$text</a>";
        }
        echo '<td class="first b b-ekphrasis">' . $num . '</td>';
        echo '<td class="t ekphrasis">' . $text . '</td>';
        echo '</tr>';

        if ( $num_posts->pending > 0 ) {
            
					$num 	=	number_format_i18n( $num_posts->pending );
					$text = _n( $singular . ' Pending', $plural . ' Pending', intval( $num_posts->pending ), 'theo' );
					
					if ( current_user_can( 'edit_posts' ) ) {
				    $num	= "<a href='edit.php?post_status=pending&post_type=ekphrasis'>$num</a>";
				    $text = "<a href='edit.php?post_status=pending&post_type=ekphrasis'>$text</a>";
					}
					echo '<td class="first b b-ekphrasis">' . $num . '</td>';
					echo '<td class="t ekphrasis">' . $text . '</td>';
					
					echo '</tr>';
					
        }
        
	}

add_action( 'right_now_content_table_end', 'theo_add_ekphrasis_count' );


/*	Bottom of the barrel, son.
----------------------------------------------------------------------	*/