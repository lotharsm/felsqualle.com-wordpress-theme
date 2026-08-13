<?php
/**
 * Title: Site search
 * Slug: felsqualle/site-search
 * Categories: text, featured
 * Keywords: search, find, query
 * Description: A standalone search page — the form on its own, framed like the rest of the site, with a tag cloud underneath as a browsing alternative.
 * Post Types: page
 * Viewport width: 900
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:paragraph -->
<p><?php echo esc_html__( 'Search the site for keywords. Results cover every post; pages are not indexed.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Search this site…","buttonText":"Search","buttonPosition":"button-outside"} /-->

<!-- wp:separator {"className":"is-style-wide"} -->
<hr class="wp-block-separator has-alpha-channel-opacity is-style-wide"/>
<!-- /wp:separator -->

<!-- wp:heading {"level":2,"fontSize":"large","fontFamily":"mono","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.06em"}}} -->
<h2 class="wp-block-heading has-mono-font-family has-large-font-size" style="letter-spacing:0.06em;text-transform:uppercase"><?php echo esc_html__( 'Or browse by tag', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:tag-cloud {"numberOfTags":40,"smallestFontSize":"0.8125rem","largestFontSize":"1rem"} /--></div>
<!-- /wp:group -->
