#!/usr/bin/env bash
set -euo pipefail

BASE_URL="${BASE_URL:-http://localhost:8081}"

echo "Running smoke tests against ${BASE_URL}..."

endpoints=(
  "/index.html"
  "/info.php"
)

fail=0

for path in "${endpoints[@]}"; do
  url="${BASE_URL}${path}"
  echo "Testing ${url}..."
  status=$(curl -o /dev/null -s -w "%{http_code}" "${url}" || echo "000")
  if [ "${status}" = "200" ]; then
    echo "PASS: ${url} returned 200."
  else
    echo "FAIL: ${url} returned ${status}."
    fail=1
  fi
done

if [ "${fail}" -eq 0 ]; then
  echo "Smoke tests passed."
  exit 0
else
  echo "Smoke tests failed."
  exit 1
fi
