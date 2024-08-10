<?php
/**
 * Gosforth Harriers & Athletics Club functions and definitions
 * 
 * @package GHAC
 * @since GHAC 0.1
 * 
 */

if ( ! function_exists( 'ghac_session' ) ) :
  function ghac_session() {
    if ( ! session_id() ) :
      session_start();
    endif;

    if ( empty( $_SESSION['ip_address'] ) ) :
      $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
    endif;

    if ( empty( $_SESSION['user_agent'] ) ) :
      $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
    endif;

    if ($_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR'] || $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) :
      // Invalidate session
      session_destroy();
    endif;

    // Do not allow to be set on live!
    //$_SESSION['relays_user_email'] = "nick@gtctek.co.uk";
  }
endif;
add_action('init', 'ghac_session');

if ( ! function_exists( 'ghac_setup' ) ) :
  function ghac_setup() {
    // Add default posts and comments RSS feed links to <head>
    add_theme_support( 'automatic-feed-links' );

    // Enable support for menus
    add_theme_support( 'menus' );

    // Enable support for post thumbnais and featured images
    add_theme_support( 'post-thumbnails' );

    // Enable support for WooCommerce
    add_theme_support( 'woocommerce' );

    // Add support for custom navigation menus.
    register_nav_menus(
      array (
        'top-menu' => __('Top Menu', 'ghac'),
        'top-menu-admin' => __('Top Menu Admin', 'ghac'),
        'useful-links' => __('Useful Links', 'ghac')
      )
    );
  }
endif;
add_action( 'after_setup_theme', 'ghac_setup' );

if ( ! function_exists( 'ghac_load_stylesheets' ) ) :
  function ghac_load_stylesheets() {
    wp_enqueue_style( 'styles', get_template_directory_uri() . '/assets/css/styles.min.css', '', '0.1.8', 'all' );
  }
endif;
add_action( 'wp_enqueue_scripts', 'ghac_load_stylesheets' );

if ( ! function_exists( 'ghac_load_javascript' ) ) :
  function ghac_load_javascript() {
    wp_enqueue_script( 'scripts', get_template_directory_uri() . '/assets/js/app.js', '', '0.1.0', 'all' );
  }
endif;
add_action( 'wp_enqueue_scripts', 'ghac_load_javascript' );

// Form Inputs
if ( ! function_exists( 'form_input_checks' ) ) :
  function form_input_checks($data, $trim = true, $slashes = true, $specialchars = true) {
    if ($trim == true) $data = trim($data);
    if ($slashes == true) $data = stripslashes($data);
    if ($specialchars == true) $data = htmlspecialchars($data);
    return $data;
  }
endif;

if ( ! function_exists( 'get_pageid_by_pageslug' ) ):
  function get_pageid_by_pageslug( $page_slug ) {
    $page = get_page_by_path( $page_slug );

    return ( ! empty( $page ) ? $page->ID : null );
  } 
endif;

if ( ! function_exists( 'get_page_permalink_by_pageslug' ) ):
  function get_page_permalink_by_pageslug( $page_slug ) {
    $pageID = get_pageid_by_pageslug( $page_slug );

    return ( ! empty( $pageID ) ? get_permalink( $pageID ) : null );
  }
endif;

/** ********************************************************************
 * 
 *  User functions
 *  
 * *********************************************************************
 */ 

if ( ! function_exists( 'is_user_in_role' ) ) :
  function is_user_in_role( $role ) {
    $user = wp_get_current_user();
    //return ( in_array( 'administrator', array_map( fn($str) => strtolower( $str ), (array) $user->roles ) ) ? true : false );
    return ( in_array( $role, array_map( fn($str) => strtolower( $str ), (array) $user->roles ) ) ? true : false );
  }
endif;

/** ********************************************************************
 * 
 *  Frontpage functions
 *  
 * *********************************************************************
 */ 

if ( ! function_exists( 'get_frontpage_feature') ) :
  function get_frontpage_feature( $col ) {
    $feature = get_page_by_path( 'front-page/feature-' . $col, OBJECT, [ 'page' ] );
    if ( ! empty( $feature ) ):
      if ( has_post_thumbnail ( $feature->ID ) ):
        $image = wp_get_attachment_image_src( get_post_thumbnail_id( $feature->ID ), 'single-post-thumbnail' );
        echo "<img src=\"" . $image[0] . "\" alt=\"test\" class=\"img-fluid\">";
      endif;
      echo apply_filters( 'the_content', $feature->post_content );
    else:
      echo "There is a problem with the template.";
    endif;
  }
endif;

/** ********************************************************************
 * 
 * WooCommerce functions
 *  
 * *********************************************************************
 */ 

function wc_override_checkout_fields( $fields ) {
  $fields['billing']['billing_company']['placeholder'] = 'Running club required when entering events';
  $fields['billing']['billing_company']['label']       = 'Club name';
  //echo "<pre>" . print_r($fields) . "</pre>";
  return $fields;
}
add_filter( 'woocommerce_checkout_fields' , 'wc_override_checkout_fields' );

function wc_form_field_args($args, $key, $value) {
  $args['input_class'] = array( 'form-control' );
  return $args;
}
add_filter('woocommerce_form_field_args',  'wc_form_field_args', 10, 3);

function wpauthors_external_add_to_cart_link() {
  global $product;

  if ( ! $product->add_to_cart_url() ) {
      return;
  }

  $product_url = $product->add_to_cart_url();
  $button_text = $product->single_add_to_cart_text();

  do_action( 'woocommerce_before_add_to_cart_button' );
  echo "<p class=\"cart\">";
  echo "<a href=\"" . esc_url( $product_url ) . "\" target=\"_blank\" rel=\"nofollow\" class=\"single_add_to_cart_button button alt\">" . esc_html( $button_text ) . "</a>";
  echo "</p>";
  do_action( 'woocommerce_after_add_to_cart_button' );
}
remove_action( 'woocommerce_external_add_to_cart', 'woocommerce_external_add_to_cart', 30 );
add_action( 'woocommerce_external_add_to_cart', 'wpauthors_external_add_to_cart_link', 30 );

if ( ! function_exists( 'woocommerce_checkout_field_club' ) ):
  function woocommerce_checkout_field_club() {
    $domain = 'woocommerce';
    $checkout = WC()->checkout;
    echo '<div id="custom_checkout_field"><h2>' . __('New Heading') . '</h2>';
    woocommerce_form_field( 
      'club_name', 
      array(
        'type' => 'text',
        'class' => array(
          'my-field-class form-row-wide'
        ),
        'label' => __('Custom Additional Field'),
        'placeholder' => __('New Custom Field'),
        'required' => false,
      ),
      $checkout->get_value('club_name')
    );
    echo '</div>';
  }
endif;
//add_action( 'woocommerce_after_order_notes', 'woocommerce_checkout_field_club');

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor || in_array("current_page_parent", $item->classes, true) || in_array("current-post-ancestor", $item->classes, true)) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}