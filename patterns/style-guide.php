<?php
/**
 * Title: Style guide
 * Slug: felsqualle/style-guide
 * Categories: text
 * Keywords: style guide, reference, tokens, typography
 * Description: Every styled element on one page — type scale, palette, links, lists, tables, quotes, code and buttons. Insert it on a private page to check the theme after changes.
 * Viewport width: 1200
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"fontFamily":"mono","fontSize":"small","textColor":"contrast-2"} -->
<p class="has-contrast-2-color has-text-color has-small-font-size has-mono-font-family"><?php echo esc_html__( 'Theme reference — keep this page private.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Type scale', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading"><?php echo esc_html__( 'Heading level three', 'felsqualle' ); ?></h3>
<!-- /wp:heading -->

<!-- wp:heading {"level":4} -->
<h4 class="wp-block-heading"><?php echo esc_html__( 'Heading level four', 'felsqualle' ); ?></h4>
<!-- /wp:heading -->

<!-- wp:heading {"level":5} -->
<h5 class="wp-block-heading"><?php echo esc_html__( 'Heading level five', 'felsqualle' ); ?></h5>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p><?php echo esc_html__( 'Body copy at the default measure. Inline elements: a link, bold text, italic text and inline code all sit on the same baseline.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Palette', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:columns {"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|20","left":"var:preset|spacing|20"}}}} -->
<div class="wp-block-columns"><!-- wp:column {"backgroundColor":"base-2","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}},"border":{"width":"1px","style":"solid"}},"borderColor":"accent"} -->
<div class="wp-block-column has-border-color has-accent-border-color has-base-2-background-color has-background" style="border-style:solid;border-width:1px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"fontFamily":"mono","fontSize":"tiny"} -->
<p class="has-tiny-font-size has-mono-font-family">base-2</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"subtle","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
<div class="wp-block-column has-subtle-background-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"fontFamily":"mono","fontSize":"tiny"} -->
<p class="has-tiny-font-size has-mono-font-family">subtle</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"accent","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
<div class="wp-block-column has-base-color has-accent-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"textColor":"base","fontFamily":"mono","fontSize":"tiny"} -->
<p class="has-base-color has-text-color has-tiny-font-size has-mono-font-family">accent</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column -->

<!-- wp:column {"backgroundColor":"contrast","textColor":"base","style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|30","right":"var:preset|spacing|30"}}}} -->
<div class="wp-block-column has-base-color has-contrast-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--30);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--30)"><!-- wp:paragraph {"textColor":"base","fontFamily":"mono","fontSize":"tiny"} -->
<p class="has-base-color has-text-color has-tiny-font-size has-mono-font-family">contrast</p>
<!-- /wp:paragraph --></div>
<!-- /wp:column --></div>
<!-- /wp:columns -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Code and preformatted text', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:code -->
<pre class="wp-block-code"><code>sudo systemctl disable --now avahi-daemon console-setup triggerhappy</code></pre>
<!-- /wp:code -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Quote', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php echo esc_html__( 'While it is tempting to disable the vc4 module as well: don\'t. I tried, and it somewhat worked.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph --><cite><?php echo esc_html__( 'BTS#3, on headless Raspberry Pi tuning', 'felsqualle' ); ?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Table', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:table {"className":"is-style-nowrap-first-column"} -->
<figure class="wp-block-table is-style-nowrap-first-column"><table><thead><tr><th><?php echo esc_html__( 'Option', 'felsqualle' ); ?></th><th><?php echo esc_html__( 'Effect', 'felsqualle' ); ?></th></tr></thead><tbody><tr><td>dtparam=audio=off</td><td><?php echo esc_html__( 'Disables the on-board sound device', 'felsqualle' ); ?></td></tr><tr><td>gpu_mem=16</td><td><?php echo esc_html__( 'Caps VideoCore memory at the 16 MB minimum', 'felsqualle' ); ?></td></tr></tbody></table></figure>
<!-- /wp:table -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Lists and table of contents', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:list {"className":"is-style-toc"} -->
<ul class="wp-block-list is-style-toc"><!-- wp:list-item -->
<li><?php echo esc_html__( 'First section', 'felsqualle' ); ?></li>
<!-- /wp:list-item -->

<!-- wp:list-item -->
<li><?php echo esc_html__( 'Second section', 'felsqualle' ); ?></li>
<!-- /wp:list-item --></ul>
<!-- /wp:list -->

<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading"><?php echo esc_html__( 'Buttons', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:buttons -->
<div class="wp-block-buttons"><!-- wp:button -->
<div class="wp-block-button"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Primary', 'felsqualle' ); ?></a></div>
<!-- /wp:button -->

<!-- wp:button {"className":"is-style-outline"} -->
<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button"><?php echo esc_html__( 'Secondary', 'felsqualle' ); ?></a></div>
<!-- /wp:button --></div>
<!-- /wp:buttons --></div>
<!-- /wp:group -->
