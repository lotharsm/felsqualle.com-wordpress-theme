<?php
/**
 * Felsqualle — theme functions.
 *
 * Deliberately small: everything visual lives in theme.json, the templates,
 * the patterns and the /styles partials. Only three things genuinely need PHP
 * — the stylesheet enqueue, removing core's skip link and the theme-color meta.
 *
 * @package Felsqualle
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Theme setup.
 */
function felsqualle_setup() {
	/*
	 * No load_theme_textdomain() call. WordPress loads translations just in
	 * time from the Domain Path declared in style.css, and from
	 * wp-content/languages/themes/ for directory-hosted builds.
	 *
	 * Block themes get post-thumbnails, responsive-embeds, html5, title-tag,
	 * automatic-feed-links and editor-styles from core automatically.
	 */
	add_theme_support( 'custom-logo' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'felsqualle_setup' );

/**
 * Front-end stylesheet. style-rtl.css is swapped in automatically when is_rtl().
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
	wp_style_add_data( 'felsqualle-style', 'rtl', 'replace' );
}
add_action( 'wp_enqueue_scripts', 'felsqualle_enqueue_styles', 20 );

/*
 * The six structural block styles — double frame, terminal, table of contents,
 * monospaced first column, summary size, plain heading — are registered
 * natively by the block-*.json partials in /styles.
 */

/**
 * Remove the skip link WordPress adds to every block theme. Core hooks it
 * under two different names depending on version, so both are unhooked.
 */
function felsqualle_remove_skip_link() {
	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_block_template_skip_link' );
	remove_action( 'wp_footer', 'the_block_template_skip_link' );
}
add_action( 'init', 'felsqualle_remove_skip_link' );

/**
 * Browser chrome colour, matching the source site's palette in both schemes.
 */
function felsqualle_theme_color() {
	echo '<meta name="theme-color" content="#f0f3f4" media="(prefers-color-scheme: light)" />' . "\n";
	echo '<meta name="theme-color" content="#171721" media="(prefers-color-scheme: dark)" />' . "\n";
}
add_action( 'wp_head', 'felsqualle_theme_color', 1 );
