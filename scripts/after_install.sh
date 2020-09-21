#!/bin/bash

set -eux

cd ~/photo-ci
php artisan migrate:refresh --force
php artisan config:cache