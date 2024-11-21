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
FOLDER="./backup/db"

if [ $# -eq 0 ]; then
ls -1t $FOLDER | sed -e 's/\.sql\.zip$//'
exit
fi

if [ $# -eq 1 ]; then
  FILE=$FOLDER/$1.sql.zip
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
  printf "\033[33m%s \033[32m== Restore Database Backup End ==\033[39m\n" "${NOW}"
fi
