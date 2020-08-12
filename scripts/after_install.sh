#!/bin/bash

set -eux

cd ~/photo-ci
php artisan migrate --force
php artisan config:cache