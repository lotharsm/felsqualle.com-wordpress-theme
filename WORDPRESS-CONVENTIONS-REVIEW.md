# WordPress conventions review

Full pass over the theme against WordPress core/block-theme conventions,
readme/style.css metadata standards, and the accessibility-ready checklist.
No code was changed for this review — every item below is a proposed change
only. Apply the ones you want; nothing here is committed.

Sources consulted: developer.wordpress.org (Theme Functions, Core Blocks
Reference), make.wordpress.org/themes/handbook (Accessibility-Ready review
process), the `core/query-title` block.json (for default heading level).

Verified as **compliant, no change needed** (listed first so the actionable
items below aren't mistaken for a complete list of problems):

- `functions.php`: no `add_theme_support()` calls is correct for a block
  theme — `post-thumbnails`, `automatic-feed-links`, `editor-styles`,
  `responsive-embeds` etc. are added automatically by core's
  `_add_default_theme_supports()` for themes with `templates/index.html`.
  `add_editor_style()` works without an explicit `editor-styles` support
  call for the same reason.
- No `index.php` needed — block themes only require `style.css` and
  `templates/index.html`.
- No PHP closing tag in `functions.php`; no direct output, so no
  escaping/sanitization gaps.
- Every template except `no-title.html` (see item 2) resolves to exactly one
  `<h1>`: `single.html`/`page.html` via `post-title` (`level:1`), `index.html`
  via a screen-reader-only `site-title` (`level:1`), `archive.html`/
  `search.html` via `query-title` (default `level` is `1`, confirmed against
  Gutenberg's `block.json`), `404.html` via an explicit `heading` block.
- Contrast spot-checks (WCAG relative-luminance formula) on the documented
  colour pairs: body text `contrast` on `base` ≈ 17:1 light / 16.6:1 dark;
  link `accent` on `base` ≈ 6.2:1 light / 11.6:1 dark; muted `contrast-2` on
  `base` ≈ 7.8:1 light / 7.7:1 dark. All clear WCAG AA (4.5:1) by a wide
  margin — the readme's AA claim checks out for these pairs.
- `.screen-reader-text` is correctly hand-rolled in `style.css`/`editor.css`
  — core doesn't ship this class on the front end, only in wp-admin.
- `theme.json` version 3, `settings`/`styles` shape, preset slug numbering
  (20/30/40… skipping 10) and block-style partial structure all match
  current schema conventions.

## Proposed changes

### 1. `readme.txt` / `style.css` — reconcile the `Tags` lists (low priority)

Current:

- `style.css`: `Tags: blog, one-column, full-site-editing, block-styles, style-variations, wide-blocks, editor-style, accessibility-ready, rtl-language-support, custom-colors, custom-logo, custom-menu, featured-images, sticky-post, threaded-comments`
- `readme.txt`: `Tags: blog, one-column, full-site-editing, block-styles, style-variations, editor-style, accessibility-ready, rtl-language-support`

The two lists disagree, and `readme.txt` is the one WordPress.org actually
indexes. Proposed: make them identical, and drop tags that don't match
current behaviour:

- `custom-logo` / `custom-menu` — these normally imply
  `add_theme_support( 'custom-logo' )` / `register_nav_menus()`, neither of
  which this theme calls (by design — it's a block theme using the Site
  Logo block and `core/navigation` `ref`s instead). Keeping them is
  arguably fine since the *capability* exists via blocks, but if this theme
  is ever submitted anywhere with automated tag validation, drop them or be
  ready to justify them.
- `sticky-post` — nothing in the templates gives a sticky post a visual
  marker; the query loops just inherit core's default sticky-first
  ordering. Either add a marker or drop the tag.
- `wide-blocks` — technically true (block support exists) but currently a
  no-op in practice, see item 4.

Proposed final tag list (`readme.txt`, mirrored into `style.css`):

```
Tags: blog, one-column, full-site-editing, block-styles, style-variations, editor-style, accessibility-ready, rtl-language-support, featured-images, threaded-comments
```

### 2. `templates/no-title.html` — no heading at all (medium priority, a11y)

Current:

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:post-content {"layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

This is the only template with zero heading blocks — no `post-title`, no
hidden `site-title`. A page using it renders with no `<h1>` at all, which
accessibility checkers (axe, WAVE, the WP accessibility-ready checklist)
flag as a heading-structure issue, and which search engines also penalize
mildly. `index.html` already solves the equivalent problem (no visible post
title on a listing page) with a visually-hidden `site-title`. Proposed:
mirror that pattern here.

```html
<!-- wp:template-part {"slug":"header","tagName":"header"} /-->

<!-- wp:group {"tagName":"main","layout":{"type":"constrained"}} -->
<main class="wp-block-group"><!-- wp:site-title {"level":1,"className":"screen-reader-text"} /-->

<!-- wp:post-content {"layout":{"type":"constrained"}} /--></main>
<!-- /wp:group -->
<!-- wp:template-part {"slug":"footer","tagName":"footer"} /-->
```

Note: this is a content template, so a hidden site-title (not a hidden post
title) is the right choice — matching `index.html`'s reasoning, since the
whole point of "no-title" is to hide the *post's own* title, not to leave
the page headingless.

### 3. `Tested up to` / `$schema` pinned two majors behind (low priority)

`readme.txt` and `style.css` both declare `Tested up to: 6.8`, and every
`$schema` (`theme.json`, all of `styles/*.json`) points at
`https://schemas.wp.org/wp/6.8/theme.json`, while the theme runs live on
WordPress 7.0.4 (per `CLAUDE.md`'s Environment section). `Tested up to` is
specifically meant to reflect the newest version verified compatible —
WordPress.org's theme-check flags a stale value. Proposed, if 7.0.4
compatibility is in fact confirmed (it appears to be, since it's the live
site's actual version):

- `readme.txt`: `Tested up to: 7.0`
- `style.css`: `Tested up to: 7.0`
- `theme.json` and every file in `styles/`: `$schema` →
  `https://schemas.wp.org/wp/7.0/theme.json`

(Leave `Requires at least: 6.8` alone — that's a floor, not a ceiling, and
lowering the floor isn't implied by any of this.)

### 4. `theme.json` — `contentSize` and `wideSize` are both `1200px` (low priority, functional)

```json
"layout": {
	"contentSize": "1200px",
	"wideSize": "1200px"
}
```

With both settings equal, choosing "wide width" on an alignable block (e.g.
an image) renders identically to the default width — the wide-alignment
block support is present but has no visible effect. `readme.txt` describes
the intended design as "46rem for prose, 1200px for wide content", which
this value pair doesn't produce.

**Caution**: a previous attempt to fix this by setting `contentSize` to
`46rem` on the `post-content` block's layout in each template was tried and
reverted — it broke the layout (see git history / prior session notes). If
revisiting this, treat it as a fresh, carefully-tested change rather than a
straight reapplication: check whether the breakage came from the block-level
override interacting badly with the framed-group markup (the double-border
groups wrapping `post-content` also set `layout: constrained` at 1200px), not
necessarily from the 46rem value itself. Test one template at a time.

### 5. `parts/header.html` / `parts/footer.html` — hardcoded `wp_navigation` IDs (low priority, portability)

```
"ref":4     — header, menu "Navigation"
"ref":118   — footer, menu "Footer"
```

These are database-specific post IDs for `wp_navigation` entries on this one
install; a fresh install/export of this theme would reference menus that
don't exist. This is a known, accepted tradeoff for a single-site theme
(documented in `CLAUDE.md`) and needs no fix unless the theme is ever
packaged for redistribution — flagged here only for completeness of a
"WordPress conventions" pass, since portable block themes are generally
expected to avoid hardcoded `ref`s (falling back to inline navigation-link
blocks or a pattern instead).

### 6. `accessibility-ready` tag and the review process (informational only)

Per the Make WordPress Themes handbook, the `accessibility-ready` tag is
only meant to be added after (or as part of requesting) a manual audit from
the accessibility team — self-applying it without that review is against
policy *for themes distributed via WordPress.org*. Since this theme isn't
in the .org directory, this has no practical consequence today, but if that
ever changes, request the audit before relying on the tag, or drop it.

### 7. `readme.txt` header field order (cosmetic)

`Tags` currently appears after `License URI`:

```
Contributors: felsqualle
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Tags: ...
```

The parser is order-independent, so this doesn't break anything, but the
conventional WordPress.org template lists `Tags` right after
`Contributors`. Purely cosmetic; reorder only if you want the file to match
the template exactly:

```
Contributors: felsqualle
Tags: ...
Requires at least: 6.8
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.4
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
```
