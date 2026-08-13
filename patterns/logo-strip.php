<?php
/**
 * Title: Logo strip
 * Slug: felsqualle/logo-strip
 * Categories: gallery, featured
 * Keywords: logos, credits, hosting, sponsors
 * Description: A row of small monochrome logos with a monospaced label, for hosting credits, sponsors or projects.
 * Viewport width: 1200
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$felsqualle_placeholder = get_template_directory_uri() . '/assets/images/placeholder.svg';
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","bottom":"var:preset|spacing|40"},"blockGap":"var:preset|spacing|30"},"border":{"top":{"width":"1px","style":"solid","color":"var:preset|color|accent"},"bottom":{"width":"1px","style":"solid","color":"var:preset|color|accent"}}},"layout":{"type":"constrained","contentSize":"1200px"}} -->
<div class="wp-block-group" style="border-top-color:var(--wp--preset--color--accent);border-top-style:solid;border-top-width:1px;border-bottom-color:var(--wp--preset--color--accent);border-bottom-style:solid;border-bottom-width:1px;padding-top:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40)"><!-- wp:heading {"level":2,"fontFamily":"mono","fontSize":"tiny","textColor":"contrast-2","className":"is-style-plain-heading","style":{"typography":{"textTransform":"uppercase","letterSpacing":"0.12em"}}} -->
<h2 class="wp-block-heading is-style-plain-heading has-contrast-2-color has-text-color has-tiny-font-size has-mono-font-family" style="letter-spacing:0.12em;text-transform:uppercase"><?php echo esc_html__( 'Projects and infrastructure', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}},"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between","verticalAlignment":"center"}} -->
<div class="wp-block-group"><!-- wp:image {"width":"120px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $felsqualle_placeholder ); ?>" alt="<?php echo esc_attr__( 'Logo placeholder', 'felsqualle' ); ?>" style="width:120px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"120px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $felsqualle_placeholder ); ?>" alt="<?php echo esc_attr__( 'Logo placeholder', 'felsqualle' ); ?>" style="width:120px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"120px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $felsqualle_placeholder ); ?>" alt="<?php echo esc_attr__( 'Logo placeholder', 'felsqualle' ); ?>" style="width:120px"/></figure>
<!-- /wp:image -->

<!-- wp:image {"width":"120px","sizeSlug":"full","linkDestination":"none"} -->
<figure class="wp-block-image size-full is-resized"><img src="<?php echo esc_url( $felsqualle_placeholder ); ?>" alt="<?php echo esc_attr__( 'Logo placeholder', 'felsqualle' ); ?>" style="width:120px"/></figure>
<!-- /wp:image --></div>
<!-- /wp:group --></div>
<!-- /wp:group -->
