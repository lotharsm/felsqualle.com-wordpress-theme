---
name: brevity-in-comments-and-commits
description: Lothar wants all source comments brief, and commit messages a single line.
metadata:
  type: feedback
---

**All comments in source files must be brief** — one or two lines, explaining
*why*. This holds in every file type: CSS, PHP, JSON, block-markup HTML, and
file-header docblocks as much as inline notes. Commit messages are a single
imperative line unless ABSOLUTELY required for large changes.

The code is the documentation. Do not restate what a rule does, recount how a
bug was found, quote generated selectors that will drift, or narrate the
alternatives that were rejected.

**Why:** said twice — first after comments running six to eight lines, then
again as a blanket rule, so treat terseness as the default rather than a
target to approach.

**How to apply:** stated generally, so it applies across repos, not just the
felsqualle theme. Mirrored in that repo's CLAUDE.md under Conventions. When
editing a file whose existing comments are long, tighten the ones you touch
rather than matching their length. See [[never-push-to-remote]].
