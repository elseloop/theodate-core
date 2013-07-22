<?php
/**
 * Plugin Name: Theodate Core Functionality
 * Plugin URI: https://github.com/needmore/Core-Functionality
 * Description: This contains all your site's core functionality so it remains available to you should you switch themes.
 * Version: 1.1.0
 * Author: Dan Manchester
 * Author URI: http://elseloop.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU 
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume 
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without 
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

// plugin folder url
if(!defined('THEO_URL')) {
  define('THEO_URL', plugin_dir_url( __FILE__ ));
}
// plugin folder path
if(!defined('THEO_DIR')) {
  define('THEO_DIR', plugin_dir_path( __FILE__ ));
}
// plugin root file
if(!defined('THEO_FILE')) {
  define('THEO_FILE', __FILE__);
}

// Post Types
include_once( THEO_DIR . '/lib/functions/post-types.php' );

// Taxonomies 
include_once( THEO_DIR . '/lib/functions/taxonomies.php' );

// Lit Journal Admin
include_once( THEO_DIR . '/lib/wp-lit-journal/journal-admin-page.php'         );
include_once( THEO_DIR . '/lib/wp-lit-journal/admin-scripts.php'              );
include_once( THEO_DIR . '/lib/wp-lit-journal/journal-toc-ajax-poetry.php'    );
include_once( THEO_DIR . '/lib/wp-lit-journal/journal-toc-ajax-ekphrasis.php' );
include_once( THEO_DIR . '/lib/wp-lit-journal/lit-journal-functions.php'      );

// P2P
include_once( THEO_DIR . '/lib/p2p/posts-to-posts.php' );
include_once( THEO_DIR . '/lib/wp-lit-journal/p2p-connections.php' );
// Metaboxes
//include_once( THEO_DIR . '/lib/functions/metaboxes.php' );
 
// Widgets
//include_once( THEO_DIR . '/lib/widgets/widget-social.php' );

// Editor Style Refresh
include_once( THEO_DIR . '/lib/functions/editor-style-refresh.php' );

// General
include_once( THEO_DIR . '/lib/functions/general.php' );