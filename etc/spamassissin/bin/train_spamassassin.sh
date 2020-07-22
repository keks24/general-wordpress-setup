#!/bin/bash
date=$(date +%F)
time=$(date +%R)
log_path="/var/log/custom"

echo "$date - $time: Train Spamassassin executed." >> $log_path/Protocol.log

# Redirect Erros and Output to Logfile
exec 2>&1 >> /var/log/spamassassin.log

# Scan HAM E-Mails (No Spam)
echo -e "\e[01;37mScanning HAM E-Mails...\e[0m"
sa-learn --no-sync --ham /home/*/Maildir/{cur,new}

# Scan SPAM E-Mails
echo -e "\e[01;37mScanning SPAM E-Mails...\e[0m"
sa-learn --no-sync --spam /home/*/Maildir/.Spam/{cur,new}

# Synchronise the Journal and Databases
echo -e "\e[01;37mSynchronising Journal and Databases...\e[0m"
sa-learn --sync

date=$(date +%F)
time=$(date +%R)
echo "$date - $time: Train Spamassassin finished." >> $log_path/Protocol.log
