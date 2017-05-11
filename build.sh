#!/bin/bash

# Online build script for nuaainfo_vue
# Author: Rex

echo "Building static files..."

node build/build.js > /dev/null

result=$?

echo "Deploying..."

if [ -d dist ] && [ $result == 0 ]; then
    echo "Replacing dist..."
    rm -rf dist
fi
mv .tmp dist

echo "Build finished."
