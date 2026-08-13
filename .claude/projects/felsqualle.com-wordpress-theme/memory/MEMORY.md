# MEMORY.md

Condensed on 2026-08-13 from the separate per-topic notes that used to live
in this directory (`brevity-in-comments-and-commits.md`, `never-push-to-remote.md`,
`felsqualle-theme-state.md`, `header-search-button.md` — all now removed,
folded in below). Facts here supplement the theme's `CLAUDE.md` (at the repo
root, referenced from here as `../../../../CLAUDE.md`) rather than repeat it —
check that file first.

## Live environment

- Live at https://dev.felsqualle.com, no staging copy — every edit is
  immediately public. Verify changes by fetching the real URL, not just by
  reading CSS/JSON.
- Flush with `wp transient delete --all` after touching `theme.json` or
  `styles/*.json`.
- The footer menu (`wp_navigation` post 118, "Footer") is empty (verified
  2026-08-13). The maintainer fills it manually. It must not stay empty once
  pages exist: an empty `wp_navigation` menu doesn't render empty — core
  falls back to the most recent `wp_navigation` post, which currently
  resolves to `core/page-list` here, showing every page instead. Setting
  `ref` doesn't avoid this; the check runs after the ref is resolved.
- The header menu (`wp_navigation` post 4, "Navigation") currently holds one
  item: a Home Link labelled "Start".
- No pages exist on the install yet (only two `Auto Draft` placeholders), so
  page-dependent behaviour (page list, footer links, the now-removed
  `no-title` template) can't be tested end to end yet.
- `.claude/settings.json` holds one-off Bash allowlist entries (tracked in
  git, not ignored — corrects the prior note, which claimed otherwise).

## Commit conventions (see also `../../../../CLAUDE.md` → Conventions, Git workflow)

- All source comments brief — one or two lines, explaining *why*, in every
  file type. Commit messages a single imperative line, body only when the
  *why* genuinely won't fit.
- Never run `git push`, even if asked — commit and stop, the maintainer
  pushes himself (no usable SSH key on this account regardless). Don't report
  a running count of unpushed commits.

## Header search button (masthead expanding search)

Core `wp:search` block, no custom JS — core owns the toggle, the
`aria-expanded`/`aria-controls` wiring, and the `.3s` transition; the theme
supplies geometry only.

- `parts/header.html`: last block in the flex group that also holds
  `wp:navigation` (`flexWrap:wrap`, `justifyContent:space-between`,
  `verticalAlignment:center`):
  `wp:search {"showLabel":false,"placeholder":"Search…","buttonPosition":"button-only","buttonUseIcon":true,"buttonBehavior":"expand-searchfield","isSearchFieldHidden":true,"className":"header-search","fontFamily":"mono"}`
- `style.css`, mirrored in `assets/css/editor.css` (minus `cursor`, per the
  three-surface mirroring rule in `../../../../CLAUDE.md`):
  ```css
  .header-search { flex: 0 0 auto; }
  .header-search .wp-block-search__inside-wrapper { align-items: center; }
  .header-search .wp-block-search__button {
  	display: inline-flex; align-items: center; justify-content: center;
  	min-width: 44px; min-height: 44px; padding: 0; cursor: pointer;
  }
  .header-search:not(.wp-block-search__searchfield-hidden) .wp-block-search__input {
  	flex-basis: min(12rem, calc(100vw - 8rem));
  	flex-grow: 0; width: auto; height: 44px; padding: 0.4em 0.6em;
  }
  .header-search:not(.wp-block-search__searchfield-hidden) .wp-block-search__button {
  	margin-inline-start: 8px;
  }
  @media (max-width: 600px) { .header-search { flex-basis: 100%; } }
  @media (pointer: coarse) { .wp-block-search__input { font-size: 16px; } }
  ```
- Why each piece exists — the parts that look arbitrary and get "cleaned up"
  by mistake:
  - **Explicit `flex-basis` on the open field.** Core collapses with
    `flex-basis: 0` and reopens with `flex-basis: 100%`, resolving against a
    content-sized form — without this the open field falls back to core's
    3rem min-width.
  - **`flex-basis: 100%` under 600px.** The closed button fits beside the nav
    but the open field doesn't; without this, opening wraps the form to a
    second line and grows the masthead ~38px on the exact phones in that
    width band.
  - **16px input font-size on coarse pointers.** `theme.json` sets
    `core/search` to the 0.875rem small preset; iOS Safari zooms the
    viewport on focus below 16px.
  - **No colour/border rules.** Core gives the button `.wp-element-button`,
    so `theme.json`'s button element styles paint it — only geometry belongs
    here. The 44px square exists because `theme.json`'s 1rem inline padding
    would otherwise make an icon-only button a wide rectangle.

## Superseded since this note was written (do not act on the old version)

- The "Known issues 3 and 4" the old notes describe as unfixed were cleared
  from `../../../../CLAUDE.md`'s Known issues section entirely on 2026-08-13,
  per explicit user instruction — current code is treated as authoritative
  until issues are manually reassigned. Don't reintroduce that tracking
  speculatively.
- The `no-title` custom template and its `patterns/site-search.php` companion
  no longer exist — `no-title` was confirmed unused and removed on
  2026-08-13, and the `patterns/` directory was dropped earlier
  (`../../../../CLAUDE.md`: "the theme's four patterns were dropped in
  favour of the ones core ships").
