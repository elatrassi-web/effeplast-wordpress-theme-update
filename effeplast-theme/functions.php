<?php
/**
 * Effe Plast Theme functions and definitions
 *
 * @package EffePlast
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Setup theme defaults and register support for various WordPress features.
 */
function effeplast_theme_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and pages.
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'effeplast' ),
			'footer' => esc_html__( 'Footer Menu', 'effeplast' ),
		)
	);

	// Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for core custom logo.
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);

	// WooCommerce Support
	add_theme_support( 'woocommerce' );
}
add_action( 'after_setup_theme', 'effeplast_theme_setup' );

/**
 * Enqueue scripts and styles.
 */
function effeplast_theme_scripts() {
	wp_enqueue_style( 'effeplast-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Enqueue Tailwind output CSS (Assuming it's generated to 'assets/css/tailwind.css' or similar. We'll stick to style.css for simplicity if we compile it directly there)
	// If you use a separate tailwind output file:
	wp_enqueue_style( 'effeplast-tailwind', get_template_directory_uri() . '/assets/css/main.css', array(), filemtime(get_template_directory() . '/assets/css/main.css') );

	// Add Alpine.js for interactive components (menus, modals, etc) - Very modern 2030 approach
	wp_enqueue_script( 'alpine-js', 'https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js', array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'effeplast_theme_scripts' );

/**
 * Create necessary directories
 */
add_action('after_setup_theme', function() {
    $dir = get_template_directory() . '/assets/css';
    if (!file_exists($dir)) {
        mkdir($dir, 0755, true);
    }
});
