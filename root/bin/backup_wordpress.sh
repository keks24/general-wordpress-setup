#!/bin/bash
date=$(date +%F)
time=$(date +%R)
log_path="/var/log/custom"
backup_source=/var/www
backup_path=/root/Backup
backup_name=wordpress.backup

echo "$date - $time: Backup executed." >> $log_path/Protocol.log

mv -v $backup_path/$backup_name.6 $backup_path/$backup_name.tmp
mv -v $backup_path/$backup_name.5 $backup_path/$backup_name.6
mv -v $backup_path/$backup_name.4 $backup_path/$backup_name.5
mv -v $backup_path/$backup_name.3 $backup_path/$backup_name.4
mv -v $backup_path/$backup_name.2 $backup_path/$backup_name.3
mv -v $backup_path/$backup_name.1 $backup_path/$backup_name.2
mv -v $backup_path/$backup_name.0 $backup_path/$backup_name.1
mv -v $backup_path/$backup_name.tmp $backup_path/$backup_name.0
cp -al $backup_path/$backup_name.1/. $backup_path/$backup_name.0
rsync -va --delete $backup_source $backup_path/$backup_name.0

date=$(date +%F)
time=$(date +%R)
echo "$date - $time: Backup finished." >> $log_path/Protocol.log
