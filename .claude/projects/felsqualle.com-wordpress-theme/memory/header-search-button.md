---
name: header-search-button
description: How the masthead's expanding search button is built, in case an uploaded theme refresh drops it.
metadata:
  type: project
---

The masthead search is a core `wp:search` block — no custom JS. Core owns the
toggle, the `aria-expanded`/`aria-controls` wiring and the .3s transition; the
theme supplies geometry only. Verbatim source is at git tag `pre-refresh-base`
(commit `d2ccd0c`, 2026-08-13), the last state before Lothar's theme refresh.

**`parts/header.html`** — last block in the flex group that also holds
`wp:navigation` (`flexWrap:wrap`, `justifyContent:space-between`,
`verticalAlignment:center`):

```
<!-- wp:search {"showLabel":false,"placeholder":"Search…","buttonPosition":"button-only","buttonUseIcon":true,"buttonBehavior":"expand-searchfield","isSearchFieldHidden":true,"className":"header-search","fontFamily":"mono"} /-->
```

**`style.css`**, mirrored in `assets/css/editor.css` minus `cursor` (see
[[four-surface-mirroring]]):

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

**Why each piece exists** — these are the parts that look arbitrary and get
"cleaned up" by mistake:

- **Explicit `flex-basis` on the open field.** Core collapses with
  `flex-basis: 0` and reopens with `flex-basis: 100%`, which resolves against a
  content-sized form, so the open field would fall back to core's 3rem
  min-width. Scoped to the open state, or the generic
  `.wp-block-search__input` rule holds it open at 90%.
- **`flex-basis: 100%` under 600px.** The closed button fits beside the nav but
  the open field does not; without this, opening wrapped the form to a second
  line and grew the masthead 38px, pushing the page down under the tap that
  caused it. Phones sit squarely in that band.
- **16px input on coarse pointers.** theme.json sets `core/search` to the
  0.875rem small preset; iOS Safari zooms the viewport on focus below 16px.
- **No colour or border rules.** Core gives the button `.wp-element-button`, so
  theme.json's button element styles paint it. Only geometry belongs here — the
  44px square exists because theme.json's 1rem inline padding would otherwise
  make an icon-only button a wide rectangle.

Unrelated: `patterns/site-search.php` is a separate standalone search page
scoped to `Post Types: page`. It is not part of this.
