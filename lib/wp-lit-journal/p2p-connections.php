<?php

/**
  *
  * Register P2P Connections
  *
  */

function theo_register_p2p_connections() {

  // poem => poet
  p2p_register_connection_type( array(
    'name'  => 'poem_to_poet',
    'from'  => array( 'poetry', 'ekphrasis' ),
    'to'    => 'theo_author'
  ) );

  // poem => issue
  p2p_register_connection_type( array(
    'name'  => 'poem_to_issue',
    'from'  => 'poetry',
    'to'    => 'issue'
  ) );

  // ekphrasis => issue
  p2p_register_connection_type( array(
    'name'  => 'ekphrasis_to_issue',
    'from'  => 'ekphrasis',
    'to'    => 'issue'
  ) );

}

add_action( 'p2p_init', 'theo_register_p2p_connections' );