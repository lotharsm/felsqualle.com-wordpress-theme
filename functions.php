<?php
/**
 * Felsqualle — theme functions. Only two things need PHP: the editor
 * stylesheet and the front-end stylesheet.
 *
 * @package Felsqualle
 * @since 1.0.0
 */

/**
 * Theme setup. Core adds every block-theme support at after_setup_theme
 * priority 1, and translations load just in time — hence nothing else here.
 */
function felsqualle_setup() {
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'felsqualle_setup' );

/**
 * Front-end stylesheet; core never enqueues style.css itself. No RTL sheet —
 * the CSS uses logical properties, as the bundled themes do.
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
	// Offers the sheet for inlining; core takes it only if its budget allows.
	wp_style_add_data( 'felsqualle-style', 'path', get_theme_file_path( 'style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'felsqualle_enqueue_styles', 20 );
