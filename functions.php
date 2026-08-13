<?php
/**
 * Felsqualle — theme functions.
 *
 * Deliberately small: everything visual lives in theme.json, the templates,
 * the patterns and the /styles partials. Only three things genuinely need PHP
 * — the stylesheet enqueue, the theme-color meta and the navigation fallback.
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
 * Front-end stylesheet. style-rtl.css is appended when is_rtl().
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

/*
 * The ten block styles — double frame, terminal, table of contents, monospaced
 * first column, summary size, plain heading, warning, error, notice and info —
 * are registered natively by the block-*.json partials in /styles.
 */

/*
 * Core's skip link is deliberately left hooked — unhooking it left WCAG 2.4.1
 * with no mechanism while readme.txt still claimed one. Core injects it ahead
 * of the first <main> and ships its own focus styles.
 */

/*
 * An empty navigation block otherwise renders the most recent menu in the
 * database — which would show the top nav's page list in the footer. Empty
 * means empty. The header nav carries its own inner blocks and never reaches
 * this fallback.
 */
add_filter( 'block_core_navigation_render_fallback', '__return_empty_array' );

/**
 * Browser chrome colour, matching the source site's palette in both schemes.
 */
function felsqualle_theme_color() {
	echo '<meta name="theme-color" content="#f0f3f4" media="(prefers-color-scheme: light)" />' . "\n";
	echo '<meta name="theme-color" content="#171721" media="(prefers-color-scheme: dark)" />' . "\n";
}
add_action( 'wp_head', 'felsqualle_theme_color', 1 );
