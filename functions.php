<?php
/**
 * Theme functions.
 */

namespace DustPressStarter;

require_once('vendor/devgeniem/dustpress/dustpress.php');

// Enable DustPress.
if ( function_exists( 'dustpress' ) ) {
    \DustPress();
}
else {
    wp_die('DustPress must be installed when using the DustPress Starter Theme!');
}

if ( ! defined( 'DIST_DIR' ) ) {
    define( 'DIST_DIR', get_template_directory_uri() . '/dist' );
}

/**
 * Theme setup
 */
function setup() {
    // Make theme available for translation
    \load_theme_textdomain( 'dustpress-demo', get_template_directory() . '/lang' );
    // Enable plugins to manage the document title
    // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
    \add_theme_support( 'title-tag' );
    // Register wp_nav_menu() menus
    // http://codex.wordpress.org/Function_Reference/register_nav_menus
    \register_nav_menus( [
        'primary_navigation' => __( 'Primary navigation', 'dustpress-demo' ),
    ] );
    // Enable post thumbnails
    // http://codex.wordpress.org/Post_Thumbnails
    // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
    // http://codex.wordpress.org/Function_Reference/add_image_size
    \add_theme_support( 'post-thumbnails' );
    // Enable HTML5 markup support
    // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
    \add_theme_support(
        'html5',
        [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ]
    );
}

\add_action( 'after_setup_theme', __NAMESPACE__ . '\\setup' );

/**
 * Add theme scripts and styles.
 */
function scripts_and_styles() {
    $theme      = \wp_get_theme();
    $version    = $theme->get( 'Version' );

    \wp_enqueue_script( 'scripts-js', DIST_DIR . '/scripts/scripts.js', [ 'jquery' ], $version, true );
    \wp_enqueue_style( 'theme-css', DIST_DIR . '/styles/style.css', [], $version, 'all' );
}

add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\scripts_and_styles' );


/**
 * Events custom post type.
 */
function geniem_custom_post_types() {
    register_post_type( 'events',
        array(
            'labels'      => array(
                'name'          => __( 'Events', 'geniem' ),
                'singular_name' => __( 'Event', 'geniem' ),
            ),
                'public'         => true,
                'has_archive'    => false,
                'menu_position'  => 5,
                'hierarchical'   => false,
                'menu_icon'      => 'dashicons-calendar-alt',
                'supports'       => array( 'title', 'editor', 'thumbnail' ),
        )
    );
}

add_action( 'init',  __NAMESPACE__ . '\\geniem_custom_post_types' );
