# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## What this is

`felsqualle.com` — a WordPress Full Site Editing (block) theme for long-form technical writing, ported from an existing static site. Text-first: double-ruled article frames, monospaced masthead, terminal-black code blocks, light and dark.

There is no build step, no package manager, no test suite, and no linter config. The files in the repo are the files WordPress serves. Edits take effect on reload.

**This theme is active on the WordPress install it lives inside** (`../../../` from the repo root). Changes are live on the running site immediately — there is no staging copy.

## Environment

WordPress 7.0.4 · PHP 8.2 · WP-CLI 2.8.1 available as `wp`.

Note the theme declares `Requires at least: 6.8` / `Tested up to: 6.8` in `style.css` and `readme.txt`, and every `$schema` points at `wp/6.8` — two majors behind the host install.

## Commands

No build/test tooling exists. These are the checks that apply:

```bash
# Validate every theme.json / style partial (a malformed one fails silently in WP)
for f in theme.json styles/*.json; do
  php -r 'json_decode(file_get_contents($argv[1])); echo (json_last_error()===JSON_ERROR_NONE?"ok  ":"BAD "), $argv[1], "\n";' "$f"
done

# Syntax-check PHP
php -l functions.php
```

From the WordPress root (`../../../`):

```bash
wp theme list                    # confirm active theme + version
wp transient delete --all        # flush cached theme.json / global styles after editing them
```

`theme.json` and the `styles/*.json` partials are cached in transients unless `WP_DEBUG` is on. **If a theme.json change appears to do nothing, flush transients before debugging further.**

Bumping the theme version in `style.css` also cache-busts the enqueued stylesheet — `functions.php` passes `wp_get_theme()->get('Version')` as the asset version.

## Git workflow

**Commit straight to `main`; do not push.** No feature branches, no pull requests — the maintainer works directly on the default branch and pushes himself. Commit the work, say it is ready, and leave `origin` alone.

`main` is the default branch; there is no `master`. `origin` is the SSH remote `git@github.com:lotharsm/felsqualle.com-wordpress-theme.git`, and this account has no key for it — pushes fail on `Permission denied (publickey)`.

## Architecture

### The core invariant

**All visual styling belongs in `theme.json`. `style.css` carries only what theme.json cannot express.** This rule is held to consistently and is the reason `functions.php` is 75 lines. Before adding CSS, check whether theme.json has a property for it.

Things theme.json genuinely cannot express, and which therefore legitimately live in CSS: `text-decoration-style` (the dotted heading underlines), `outline`, `white-space`, `color-mix()` grounds, `:has()` conditionals, media queries, print rules.

### The four-surface mirroring obligation

This is the most important thing to know, and the source of the bug class this theme is prone to. A single visual rule outside theme.json may need to be written in **up to four places**:

| Surface | File | Applies when |
|---|---|---|
| Front end | `style.css` | always |
| Editor canvas | `assets/css/editor.css` | always — same rule, prefixed `.editor-styles-wrapper` |
| RTL | `style-rtl.css` | rule is directional and not already using logical properties |
| Dark | `style.css` dark block **and** `styles/dark.json` | rule references a palette color that flips (see below) |

`editor.css` is a deliberate near-copy of `style.css`. Two divergences are intentional and documented at the top of that file: `.screen-reader-text` stays visible in the canvas, and the `prefers-color-scheme` block is *not* mirrored (the editor shows the author's chosen variation, not the device's).

**When you change a rule in `style.css`, check whether `editor.css` has a twin that needs the same change.**

### Two independent dark-mode paths

Dark mode can arrive by either route, and a fix applied to one does **not** cover the other:

1. **Device preference** — `style.css` redefines the `--wp--preset--color--*` custom properties at `:root` inside `@media (prefers-color-scheme: dark)`. Automatic, no setting needed.
2. **Pinned variation** — `styles/dark.json` is a style variation an author can select in Appearance → Editor → Styles, which overrides the device.

Any dark-mode correction generally needs to land in **both**.

**The trap:** the dark block flips what the tokens *mean*. `base` goes from `#f0f3f4` (light ground) to `#171721` (dark ground). So **any rule using `base` as a foreground color breaks in dark mode** — it becomes near-black text. `style.css` already patches this for `.wp-block-code` / `.wp-block-preformatted` by reassigning them to `contrast`; `dark.json` does the same. Grep for `color: var(--wp--preset--color--base)` when touching anything on a dark ground.

### Specificity is controlled by enqueue order, not selectors

`functions.php` declares `wp-block-library` and `global-styles` as dependencies of `felsqualle-style` **purely to force print order**, so the theme's rules win equal-specificity conflicts against core block styles without needing `!important` or inflated selectors.

Consequences worth understanding before changing it:

- The handful of `!important` uses that remain are documented in-place and fight specific core rules (constrained-layout auto-margins on featured images, the monospace stack that core's block rules would otherwise re-specify).
- Because the theme sheet prints *after* `global-styles`, the dark `:root` block also overrides colors an author sets in the Site Editor — but only on dark devices.

### Block styles need no PHP

The ten custom block styles are registered natively by the `styles/block-*.json` partials (WP 6.6+ route). To add one: drop in a `styles/block-<slug>.json` with `title`, `slug`, `blockTypes`, `styles`, and put anything theme.json can't express in `style.css` + `editor.css` against `.is-style-<slug>`.

Several partials are near-empty by design (`block-nowrap-first-column.json` has `"styles": {}`) — they exist to register the style name so the class becomes available, with all the real CSS in `style.css`.

### Layout

- `templates/` — index, single, page, archive, search, 404, plus one custom template declared in `theme.json` → `customTemplates` (`no-title`).
- `parts/` — header, footer, post-meta, sidebar. All four are declared in `theme.json` → `templateParts`; post-meta and sidebar use area `uncategorized`.
- No `patterns/` directory. The theme's four patterns were dropped in favour of the ones core ships; `functions.php` is now the only PHP file.
- Text domain is `felsqualle`; the directory name is not. There is deliberately no `load_theme_textdomain()` call — WP loads translations just in time.

Templates are near-duplicates of each other by necessity (block templates have no partials beyond template parts and no conditionals). The index/archive/search query loops are largely the same markup; changes to one usually need repeating in the others.

Blog listings render **full `post-content`**, not excerpts — that is the text-first intent, not an oversight. Search results are the exception and use excerpts.

### Deliberate constraints, do not "fix" casually

- `html { overflow-x: hidden }` in `style.css` disables `position: sticky`, which is why `theme.json` sets `settings.position.sticky: false` rather than offering an option that cannot work. The two are coupled.
- `body { margin: 0 }` plus `useRootPaddingAwareAlignments: false` is what lets the framed groups reach the viewport edge. The narrow-screen inset is re-added selectively in a `max-width: 600px` block.
- `query-pagination-numbers` sets `midSize: 99` so core renders every page link, then CSS collapses them to `1 2 … 98 99`. This avoids a PHP filter; `paginate_links` cannot produce two links at each end.
- Navigation never collapses to an overlay — the toggle buttons are hidden and the menu wraps instead.

## Known issues

From an initial review. Items 1, 2, 5 and 6 are fixed; 3 and 4 remain.

3. **Reading measure mismatch.** `readme.txt` documents "46rem for prose, 1200px for wide content"; `theme.json` sets `contentSize` *and* `wideSize` to `1200px`. Prose runs full width and `alignwide` is a no-op. Decided fix, not yet made: `"contentSize":"46rem"` on the `post-content` block's constrained layout in the templates, leaving the frames at 1200px.
4. **`.is-style-summary` is inert.** `block-summary.json` sets only the 2em margins `style.css` already gives every `.wp-block-post-featured-image`. Decided fix, not yet made: move the 400px cap off the blanket rule onto `.is-style-summary`, in `style.css` and `editor.css` both, uncapping single-post featured images.

Two traps worth keeping, from fixing the rest:

- **Block style variation CSS is per instance and comes from its own handle.** `block-style-variation-styles` is not a dependency of `felsqualle-style`, so print order against it is not guaranteed, and its selectors score 0,1,0. Duplicating a variation's properties in `style.css` silently defeats `dark.json` — that was the terminal bug.
- **`'rtl' => 'replace'` swaps the sheet, it does not add to it.** Correct only for a full rtlcss mirror. `style-rtl.css` here is a short overrides file, so it must stay `true`.

## Conventions

- Tabs for indentation, in CSS, PHP and JSON alike.
- **Be brief.** Comments run one to three lines and explain *why* — the code says what it does. Where a rule exists to fight a specific core behaviour, name the behaviour and stop; preserve that reasoning when editing, since several rules look arbitrary without it. Don't restate a rule in prose, don't recount how a bug was found, and don't quote generated selectors that will drift.
- Commit messages are a single imperative line. Add a body only when the *why* genuinely will not fit, which is rare.
- Every PHP file opens with an `ABSPATH` guard.
- Functions are prefixed `felsqualle_`.
