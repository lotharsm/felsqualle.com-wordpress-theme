<?php
/**
 * Title: FAQ — accordion
 * Slug: felsqualle/faq
 * Categories: text, featured
 * Keywords: faq, questions, accordion, details
 * Description: Collapsible questions and answers built on the core Details block, so it works without JavaScript.
 * Viewport width: 900
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:heading {"level":2,"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size"><?php echo esc_html__( 'Frequently asked questions', 'felsqualle' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:details {"showContent":true,"summary":"<?php echo esc_attr__( 'Can I reuse the patches and scripts from these articles?', 'felsqualle' ); ?>"} -->
<details class="wp-block-details" open><summary><?php echo esc_html__( 'Can I reuse the patches and scripts from these articles?', 'felsqualle' ); ?></summary><!-- wp:paragraph -->
<p><?php echo esc_html__( 'Yes. Unless a post says otherwise, everything published here is free to reuse and adapt. Attribution is appreciated but not required.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'Do you take article suggestions?', 'felsqualle' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'Do you take article suggestions?', 'felsqualle' ); ?></summary><!-- wp:paragraph -->
<p><?php echo esc_html__( 'Send an e-mail. Topics that involve an obsolete platform and a stubborn bug tend to get answered fastest.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details {"summary":"<?php echo esc_attr__( 'Is there a feed?', 'felsqualle' ); ?>"} -->
<details class="wp-block-details"><summary><?php echo esc_html__( 'Is there a feed?', 'felsqualle' ); ?></summary><!-- wp:paragraph -->
<p><?php echo esc_html__( 'There is, and it carries full article text. No mail signup needed.', 'felsqualle' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group -->
