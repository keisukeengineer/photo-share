#!/bin/bash

set -eux

cd ~/server
php artisan migrate:refresh --force
php artisan config:cache