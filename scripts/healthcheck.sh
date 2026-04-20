#!/usr/bin/env bash
set -euo pipefail

APP_URL="${APP_URL:-http://localhost:8081}"

echo "Checking application health at ${APP_URL}/info.php..."

status=$(curl -o /dev/null -s -w "%{http_code}" "${APP_URL}/info.php" || echo "000")

if [ "${status}" = "200" ]; then
  echo "App is healthy (info.php returned 200)."
  exit 0
else
  echo "App health check failed (info.php returned ${status})."
  exit 1
fi
