#!/bin/bash
required=(
  ".env"
  "composer.json"
  "composer.lock"
  "public/"
  "src/"
  "SQLDatabase/"
  "startup.sh"
)

for item in "${required[@]}"; do
  if [ ! -e "$item" ]; then
    echo "MISSING REQUIRED FILE/DIR: $item"
    exit 1
  fi
done

echo "All required files/directories present"
exit 0
