<?php
/**
 * aero functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package aero
 */

if ( ! function_exists( 'aero_setup' ) ) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function aero_setup() {

        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on aero, use a find and replace
         * to change 'aero' to the name of your theme in all the template files.
         */
        load_theme_textdomain( 'aero', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus( array(
            'main-menu-top' => esc_html__( 'Main Menu Top', 'aero' ),
            'social' => esc_html__( 'Socials', 'aero'),
        ) );

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Set up the WordPress core custom background feature.
        add_theme_support( 'custom-background', apply_filters( 'aero_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
    }
endif;
add_action( 'after_setup_theme', 'aero_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function aero_content_width() {
//     // This variable is intended to be overruled from themes.
//     // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
//     // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
//     $GLOBALS['content_width'] = apply_filters( 'aero_content_width', 640 );
// }
// add_action( 'after_setup_theme', 'aero_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function aero_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'aero' ),
        'id'            => 'sidebar-1',
        'description'   => esc_html__( 'Add widgets here.', 'aero' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'aero_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function aero_scripts() {
    wp_enqueue_style( 'aero-style', get_stylesheet_uri() );
    wp_enqueue_script( 'aero-bundle', get_theme_file_uri( '/js/bundle.js' ), array(), '1.0', true );

/*Inserted automatically by gulp (gulp copy:js) Start*/
/*SCRIPTS*/
/*Inserted automatically by gulp (gulp copy:js) End*/

}
add_action( 'wp_enqueue_scripts', 'aero_scripts' );


/** Unchecks the "Crop thumbnail to exact dimensions" checkbox in Settings-Media-Thumbnail (and prevents it from being checked).
*/
add_filter( 'pre_option_thumbnail_crop', '__return_zero' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom menu
 */
require get_template_directory() . '/inc/custom-menu.php';

/**
*/
require get_template_directory() . '/inc/icon-functions.php';

/**
* Custom post types
*/
require get_template_directory() . '/inc/custom-types-and-tax.php';

/**
* Custom options page
*/
require get_template_directory() . '/inc/options-page.php';

/**
* Custom shortcodes
*/
require get_template_directory() . '/inc/custom-shortcode.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
    require get_template_directory() . '/inc/jetpack.php';
}


if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
