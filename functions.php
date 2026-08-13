<?php
/**
 * Felsqualle — theme functions. Only two things need PHP: the editor
 * stylesheet and the front-end stylesheet.
 *
 * @package Felsqualle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup. Core adds every block-theme support at after_setup_theme
 * priority 1, and translations load just in time — hence nothing else here.
 */
function felsqualle_setup() {
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'felsqualle_setup' );

/**
 * Front-end stylesheet; core never enqueues style.css itself. RTL is `true`,
 * not 'replace', which would serve style-rtl.css instead of style.css.
 */
function felsqualle_enqueue_styles() {
	// Depend on the core block library and global styles to force print order,
	// so this sheet wins equal-specificity conflicts.
	wp_enqueue_style(
		'felsqualle-style',
		get_stylesheet_uri(),
		array( 'wp-block-library', 'global-styles' ),
		wp_get_theme()->get( 'Version' )
	);
	wp_style_add_data( 'felsqualle-style', 'rtl', true );
}
add_action( 'wp_enqueue_scripts', 'felsqualle_enqueue_styles', 20 );

/* The ten block styles are registered natively by the block-*.json partials in /styles. */

/* Core's skip link is left hooked; unhooking it left WCAG 2.4.1 with no mechanism. */

/* No theme-color meta: style.css declares color-scheme and paints the same
   base colours, so the browser derives its chrome from the page itself. */
