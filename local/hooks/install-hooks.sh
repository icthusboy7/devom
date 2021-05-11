#!/bin/sh

cd "$(dirname "$0")/../.."

rm -rf .git/hooks

ln -s local/hooks .git/hooks
chmod -R 777 local/hooks/*
