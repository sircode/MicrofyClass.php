#!/usr/bin/env bash
set -euo pipefail

# Lint all PHP files in the repository
find . -name '*.php' -print0 | xargs -0 -n 1 php -l
