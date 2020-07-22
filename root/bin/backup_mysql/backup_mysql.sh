#!/bin/bash
date=$(date +%F)
time=$(date +%R)
log_path="/var/log/custom"
backup_path=/root/Backup/mysql
backup_name=("wordpress.backup" "piwik.backup")
current_day_count_path=/root/bin/Backup_MySQL
current_day_count_file=current_day_count.txt
current_day_count=`cat $current_day_count_path/$current_day_file`

echo "$date - $time: Backup MySQL executed." >> $log_path/Protocol.log

if [ $current_day_count == 7 ]
then
    echo "0" > $current_day_count_path/$current_day_file
    #current_day_count=1
    current_day_count=`cat $current_day_count_path/$current_day_file`
fi

mysqldump --defaults-extra-file=/etc/mysql/my.cnf -u root wordpress > $backup_path/${backup_name[0]}.$current_day_count.sql
mysqldump --defaults-extra-file=/etc/mysql/my.cnf -u root piwik > $backup_path/${backup_name[1]}.$current_day_count.sql

(( current_day_count++ ))
echo "$current_day_count" > $current_day_count_path/$current_day_file

date=$(date +%F)
time=$(date +%R)
echo "$date - $time: Backup MySQL finished." >> $log_path/Protocol.log
