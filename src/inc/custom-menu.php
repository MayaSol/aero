<?php
function aero_nav_class( $classes, $item, $args ) {

	if ( isset($args->menu_class) ) {
		$block = explode(' ', $args->menu_class)[0];
    $strpos = strpos($block,'__');
    if ($strpos) {
      $block = substr($block,0,$strpos);
    }
    array_unshift($classes, $block . '__item');
	}

    return $classes;
}
add_filter( 'nav_menu_css_class' , 'aero_nav_class' , 10, 4 );


function aero_nav_links( $atts, $item, $args ) {
    // Manipulate attributes

//    write_log('$args: ');
//    write_log($args);

	$menu_class = strpos($args->menu_class,'__') ? strstr($args->menu_class,'__',true) : $args->menu_class;
//	write_log('$menu_class: ' . $menu_class);
	$atts['class'] = $menu_class . '__link';

    return $atts;
}
add_filter( 'nav_menu_link_attributes', 'aero_nav_links', 10, 3 );
