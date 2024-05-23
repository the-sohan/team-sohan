<?php

/* Enqueues front scripts. */
add_action( 'wp_enqueue_scripts', 'add_stp_scripts', 99 );
function add_stp_scripts() {

  /* Front end CSS. */
  wp_enqueue_style( 'stm-style', plugins_url('css/stp_front_style.css', __FILE__));
  
}