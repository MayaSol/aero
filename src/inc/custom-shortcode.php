<?php

function site_contacts_func($atts) {
  $result = '';
  $email = esc_html( get_option('email') );
  if ($email) {
    $result = $result . '<p><a class="page-contacts__link" href="mailto:' . $email . '">Email: ' . $email . '</a></p>';
  }
  $phone = esc_html( get_option('phone_number_01') );
  if ($phone) {
    $result = $result . '<p><a class="page-contacts__link" href="tel:' . $phone . '">' . $phone . '</a></p>';
  }

  return $result;
}
add_shortcode( 'site-contacts', 'site_contacts_func' );


function get_post_content_func( $atts = array() ) {
  // Set defaults.
  $defaults = array(
    'slug'        => '',
    'type'        => 'post',
    'class'       => '',
    'title'       => '',
    'title-class' => ''
  );

  // Parse args.
  $atts = wp_parse_args( $atts, $defaults );


  $args = [
    'post_status' => 'publish',
    'name' => $atts['slug'],
    'post_type' => $atts['type']
  ];

  $the_query = new WP_Query( $args );

//  write_log($the_query->request);

  if ( $the_query->have_posts() ) :

    $before = '<article>';

    if ($atts['class']) {
      $before = '<article class="' . $atts['class'] . '">';
    }

    $after = '</article>';

    $title = '';


    if ($atts['title']) {
      $title_before = '<div>';

      if ($atts['title-class']) {
        $title_before = '<div class="' . $atts['title-class'] . '">';
      }

      $title_after = '</div>';

      $title = $title_before . $atts['title'] . $title_after;
    }


    $before = $before . $title;


    while ( $the_query->have_posts() ) :
      $the_query->the_post();
      return $before . apply_filters( 'the_content', get_the_content() ) . $after;
    endwhile;
  endif;

  return "Нет поста";
}
add_shortcode( 'get_post_content', 'get_post_content_func' );

function get_post_title_func( $atts ) {
  $args = [
    'post_status' => 'publish',
    'name' => $atts['slug'],
    'post_type' => $atts['type']
  ];

  $the_query = new WP_Query( $args );

  write_log($the_query->request);

  if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) :
      $the_query->the_post();
      return apply_filters( 'the_content', get_the_content() );
    endwhile;
  endif;

  return "Нет поста";
}
add_shortcode( 'get_post_content', 'get_post_content_func' );


function get_page_content_func( $atts ) {
  $args = [
    'post_status' => 'publish',
    'pagename' => $atts['slug'],
  ];

  $the_query = new WP_Query( $args );

  if ( $the_query->have_posts() ) :
    while ( $the_query->have_posts() ) :
      $the_query->the_post();
      return get_the_content();
    endwhile;
  endif;

  return "Нет такой страницы";
}
add_shortcode( 'get_page_content', 'get_page_content_func' );

