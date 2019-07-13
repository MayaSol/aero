<?php
/**
 * aero Theme Customizer
 *
 * @package aero
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function aero_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'aero_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'aero_customize_partial_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'aero_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function aero_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function aero_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function aero_customize_preview_js() {
	wp_enqueue_script( 'aero-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'aero_customize_preview_js' );

/**
 * Wrap embedded videos with <div class="embed-responsive"></div> instead of <p></p>
 * Class "embed-responsive" stylized in app/blocks/embed-responsive/embed-responsive.styl
 * It makes videos responsive to screen width
 *
 * Оборачивает встроенные в пост видео в теги <div class="embed-responsive"></div>, вместо <p></p>
 * Класс "embed-responsive" стилизован в app/blocks/embed-responsive/embed-responsive.styl
 * Он делает видео адаптивными
 */

function responsive_embed_oembed_html($html, $url, $attr, $post_id) {
	// write_log('responsive_embed_oembed_html--------------------------');
	// write_log('$html: ');
	// write_log($html);
	// write_log('$url');
	// write_log($url);
	// write_log('$attr');
	// write_log($attr);
	// write_log('$post_id');
	// write_log($post_id);

	return $html;
}

//add_filter('embed_oembed_html', 'responsive_embed_oembed_html', 99, 4);

//		return apply_filters( 'oembed_result', $this->data2html( $data, $url ), $url, $args );


function get_oembed_result($data, $url, $args) {
	// write_log('get_oembed_result-----------------------');
	// write_log('$data: ');
	// write_log($data);
	// write_log('$url: ');
	// write_log($url);
	// write_log('$args: ');
	// write_log($args);
	return $data;
}

//add_filter( 'oembed_result', 'get_oembed_result', 99, 4 );


//		return apply_filters( 'oembed_dataparse', $return, $data, $url ); class_oembed.php



function wrap_oembed_dataparse($return, $data, $url) {
	// write_log('get_oembed_dataparse-----------------------');
	// write_log('$data: ');
	// write_log($data);
	// write_log('$url: ');
	// write_log($url);
	// write_log('$return: ');
	// write_log($return);

	$mod = '';

	if  (   ( $data->type == 'video' ) &&
			( isset($data->width) ) && ( isset($data->height) ) &&
			( round($data->height/$data->width, 2) == round( 3/4, 2) )
		)
	{
		$mod = 'embed-responsive--4-3';
	}

	return '<div class="embed-responsive ' . $mod . '">' . $return . '</div>';
}

add_filter( 'oembed_dataparse', 'wrap_oembed_dataparse', 99, 4 );


// Filters 'embed_oembed_discover' and  'oembed_ttl' to clear oEmbed post-meta cache
// Если 'oembed_dataparse' не срабатывает, то надо однократно очистить oEmbed post-meta cache

add_filter( 'oembed_ttl', function($ttl) {
	  $GLOBALS['wp_embed']->usecache = 0;
            $ttl = 0;
            // House-cleanoing
            do_action( 'wpse_do_cleanup' );
	return $ttl;
});

add_filter( 'embed_oembed_discover', function( $discover )
{
    if( 1 === did_action( 'wpse_do_cleanup' ) )
        $GLOBALS['wp_embed']->usecache = 1;
    return $discover;
} );


