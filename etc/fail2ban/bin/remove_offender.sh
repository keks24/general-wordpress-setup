#!/bin/bash
sed -i "\|$1|d" /etc/fail2ban/ip.blocklist.repeatoffender
echo "$1 removed from Repeat Offender Blocklist"

sed -i "\|$1|d" /var/log/fail2ban.log
echo "$1 removed from Current Fail2Ban Log"

sed -i "\|$1|d" /var/log/fail2ban.log-*
echo "$1 removed from Rotated Fail2Ban Logs"
