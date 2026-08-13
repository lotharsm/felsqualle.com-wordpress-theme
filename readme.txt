=== felsqualle.com ===

Contributors: felsqualle
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: blog, one-column, full-site-editing, block-patterns, block-styles, style-variations, editor-style, accessibility-ready, rtl-language-support, translation-ready

A text-first block theme for technical writing, derived from felsqualle.com.

== Description ==

Felsqualle is a full-site-editing theme built around long-form technical
articles. It keeps the double-ruled article frames, monospaced masthead and
terminal-black code blocks of the original site, on a modernised reading
measure (46rem for prose, 1200px for wide content).

Everything visual is defined in theme.json. style.css only carries the handful
of rules theme.json cannot express — dotted heading underlines, table borders,
the skip link, print and reduced-motion rules.

= Templates =

* index — blog fallback
* single — article, post meta, navigation, comments, latest posts
* page
* no-title — custom template, content only
* style-guide — custom template, inserts the style guide pattern
* archive — category, tag and date archives
* search
* 404

= Template parts =

header, footer, post-meta, sidebar

= Patterns =

felsqualle/logo-strip, felsqualle/faq, felsqualle/style-guide,
felsqualle/site-search

felsqualle/site-search is scoped to pages, so it appears in the pattern picker
when you create one. Add a page titled "Site Search", insert it, and the page
template supplies the frame, the title and the meta line.

= Style variations =

Default (light, blue #3333ff accent) and Dark (#171721 with a pink #ffc0cb
accent), matching the light and dark schemes of the source site.

The scheme follows the device automatically: style.css redefines the palette's
custom properties inside a prefers-color-scheme: dark media query, exactly as
the source site does. No setting is required. The Dark variation under
Appearance → Editor → Styles is still there for anyone who wants to pin the
dark palette regardless of the device.

= Custom block styles =

* Group: Double frame, Terminal, Table of contents
* List: Table of contents
* Table: Monospaced first column
* Featured image: Summary size
* Heading: No dotted underline
* Group, Paragraph, List, Quote: Warning, Error, Notice, Info

All ten are registered by the block-*.json partials in styles/, the native
route from WordPress 6.6 onwards, so the theme needs no PHP for them. Rules
theme.json cannot express — outline, width, white-space, the mixed callout
ground — stay in style.css against the same is-style-* classes.

== Fonts ==

No webfonts. Two families are registered in theme.json, both reproducing the
source stylesheet's stacks verbatim:

* System sans (slug: body) — body copy
* System mono (slug: mono) — masthead, code, captions, post meta

Nothing is downloaded at runtime and no font files ship with the theme, which
is how the original site works.

== Installation ==

1. Copy the felsqualle folder into wp-content/themes/, or upload the zip via
   Appearance → Themes → Add New → Upload Theme.
2. Activate it.
3. Set a static front page under Settings → Reading if you want the hero
   layout; otherwise the blog index is used.
4. Create the navigation menu items you need (Start, Archive, Tags, Search).

== Accessibility ==

* Skip link to the main landmark.
* Visible 2px focus ring on all interactive elements.
* 44px minimum hit target on coarse pointers.
* Text and link colours meet WCAG 2.1 AA against both backgrounds.
* prefers-reduced-motion and prefers-contrast honoured.

== Changelog ==

= 1.0.3 =
* Search fields no longer trigger the iOS zoom-on-focus that shifted the layout.
* The masthead search no longer reflows the header when it opens on a phone.

= 1.0.2 =
* Added an expanding search button to the masthead, beside the navigation.

= 1.0.1-rc =
* Initial release.
