#!/bin/bash
#
# Description:
# List or Get remote backup files
# remote directory details as input
# Restore backup to database
#
# Use batch file with SFTP shell script without prompting password
# using SFTP authorized_keys
#
# Usage:
#   List: sh restore_backup.sh
#   Restore : sh restore_backup.sh <remote_file_name>
#
##################################################################
DB=cpanel
USERDB=cpanel
PWD=AdminCpanel2024
SSHUSER=rcosta
IP=83.174.46.125

remote_dir="/backup/vhost/agregacao.energiasimples.pt/backup/db"
if [ $# -eq 0 ]; then
  sftp $SSHUSER@$IP <<%EOF%
cd $remote_dir
ls -1t
exit
%EOF%
fi

NOW=$(date +'%F %H:%M:%S')
printf "\033[33m%s \033[32m== Get Remote File ==\033[39m\n" "${NOW}"
# Get Existing File
if [ $# -eq 1 ]; then
  FILE=$1.sql.zip
  sftp $SSHUSER@$IP <<%EOF%
cd $remote_dir
mget $FILE
exit
%EOF%
  NOW=$(date +'%F %H:%M:%S')
  printf "\033[33m%s \033[32m== Database Restore Backup Start ==\033[39m\n" "${NOW}"
  NOW=$(date +'%F %H:%M:%S')
  printf "\033[33m%s \033[32m== UNZIP backup ==\033[39m\n" "${NOW}"
  # UNZIP backup
  unzip "$FILE"
  NOW=$(date +'%F %H:%M:%S')
  printf "\033[33m%s \033[32m== Restore backup ==\033[39m\n" "${NOW}"
  # Restore backup
  mysql -u $USERDB -p$PWD $DB <"$1.sql"
  # Delete Files
  NOW=$(date +'%F %H:%M:%S')
  printf "\033[33m%s \033[32m== Delete Files ==\033[39m\n" "${NOW}"
  rm "$1".sql*
  NOW=$(date +'%F %H:%M:%S')
  printf "\033[33m%s \033[32m== Database Restore Backup End ==\033[39m\n" "${NOW}"
fi
