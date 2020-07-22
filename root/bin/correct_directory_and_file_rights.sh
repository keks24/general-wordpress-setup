#!/bin/bash
wordpress_path=/var/www/html
echo "Setting directory access rights to 775..."
find $wordpress_path -type d -exec chmod 775 {} \;

echo "Setting file access rights to 644..."
find $wordpress_path -type f -exec chmod 644 {} \;
