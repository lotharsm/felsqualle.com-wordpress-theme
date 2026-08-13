---
name: never-push-to-remote
description: Never run git push; commit and stop, Lothar pushes himself.
metadata:
  type: feedback
---

Do not attempt `git push`, even when explicitly asked to push. Commit the work,
report that it is ready, and leave the remote alone.

Do not report a running count of unpushed commits — he tracks that himself.

**Why:** this account has no usable SSH key — pushes fail on `Permission denied
(publickey)` — and Lothar handles pushing himself.

**How to apply:** applies even where a repo's own CLAUDE.md documents a
"commit and push straight to main" workflow, as the felsqualle.com theme does.
That instruction describes his workflow, not mine. See
[[brevity-in-comments-and-commits]].
