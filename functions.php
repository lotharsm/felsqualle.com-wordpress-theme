<?php
/**
 * Felsqualle — theme functions.
 *
 * Deliberately small: everything visual lives in theme.json, the templates and
 * the /styles partials. Only three things genuinely need PHP — the editor
 * stylesheet, the front-end stylesheet and the theme-color meta.
 *
 * @package Felsqualle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup. Core adds every other support a block theme uses at
 * after_setup_theme priority 1; translations load just in time, so there is
 * deliberately no load_theme_textdomain() call.
 */
function felsqualle_setup() {
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'felsqualle_setup' );

/**
 * Front-end stylesheet. Core never enqueues style.css itself, block theme or not.
 *
 * `true`, not 'replace': 'replace' serves style-rtl.css INSTEAD OF style.css,
 * which suits a full rtlcss mirror, not this short overrides file.
 */
function felsqualle_enqueue_styles() {
	// Depend on the core block library and global styles so this sheet is
	// printed after them and wins equal-specificity conflicts.
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

/**
 * Browser chrome colour, matching the source site's palette in both schemes.
 * WordPress has no native theme-color support.
 */
function felsqualle_theme_color() {
	echo '<meta name="theme-color" content="#f0f3f4" media="(prefers-color-scheme: light)" />' . "\n";
	echo '<meta name="theme-color" content="#171721" media="(prefers-color-scheme: dark)" />' . "\n";
}
add_action( 'wp_head', 'felsqualle_theme_color', 1 );
