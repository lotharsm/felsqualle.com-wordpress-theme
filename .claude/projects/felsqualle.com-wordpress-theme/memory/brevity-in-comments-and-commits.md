---
name: brevity-in-comments-and-commits
description: Lothar wants brief commit messages and brief comments; code should document itself.
metadata:
  type: feedback
---

Keep commit messages to a single imperative line, and code comments to roughly
one to three lines explaining *why*. The code itself is the documentation — do
not restate in prose what a rule does, recount how a bug was found, or quote
generated selectors that will drift.

**Why:** given after a round of fixes where the comments I wrote ran six to
eight lines each and read as narrative rather than reference.

**How to apply:** stated as a general rule, so treat it as applying across
repos, not just the felsqualle theme. Also recorded in that repo's CLAUDE.md
under Conventions.
