---
name: felsqualle-theme-state
description: Open items and live-environment facts for the felsqualle.com theme that CLAUDE.md does not carry.
metadata:
  type: project
---

The theme is live on https://dev.felsqualle.com with no staging copy — every
edit is immediately public. Verify changes by fetching the real URL, not by
reading CSS. Flush with `wp transient delete --all` after touching theme.json.

Open as of 2026-08-13, after a session refactoring toward FSE conventions:

- **Known issues 3 and 4** (reading measure, inert `.is-style-summary`) are
  still unfixed. Both have an approach agreed and recorded in CLAUDE.md; issue
  3 was attempted once and reverted, so do not re-apply it unprompted.
- **The footer menu (`wp_navigation` 118, "Footer") is empty.** Lothar fills it
  manually. It must not stay empty once pages exist, or core's fallback renders
  the full page list.
- **No pages exist on the install yet**, so page-dependent behaviour (page
  list, footer links) cannot be tested end to end.
- `.claude/settings.json` is untracked and holds one-off Bash allowlist entries;
  it was left out of git deliberately.

Working style he has confirmed: verify against core source and the live site
rather than asserting, and say plainly when something cannot be verified. See
[[brevity-in-comments-and-commits]] and [[never-push-to-remote]].
