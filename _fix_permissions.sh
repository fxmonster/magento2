#!/bin/sh
#find /var/www/vhosts/shop.zap3.net/httpdocs -type f -exec chmod 644 {} \;
#find /var/www/vhosts/shop.zap3.net/httpdocs -type d -exec chmod 755 {} \;
chown -R shop:psacln /var/www/vhosts/shop.zap3.net/httpdocs/*

chmod +x _fix_permissions.sh
chmod +x bin/magento
# chmod +x bin/ubdatamigration

