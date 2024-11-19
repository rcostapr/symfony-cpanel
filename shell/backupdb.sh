#!/bin/bash
# DATABASE BACKUP SYSTEM
## CREATE BACKUP and REMOVE 4 DAYS AGO BACKUP
BCK=$(date +%F)
BCKREMOVE=$([ "$(uname)" = Linux ] && date --date="4 days ago" +"%F" || date -v-4d +"%Y"-"%m"-"%d")
FOLDER="./backup/db"
DB=cpanel
USERDB=cpanel
PWD=AdminCpanel2024
## CHECK IF FOLDER EXIST
if [ ! -d $FOLDER ]; then
    NOW=$(date +'%F %H:%M:%S')
    printf "\033[33m${NOW} \033[32m== Creating folder ${FOLDER}\033[39m\n"
    mkdir -p $FOLDER
fi
NOW=$(date +'%F %H:%M:%S')
printf "\033[33m${NOW} \033[32m== Backup Database\033[31m ${DB} \033[32m to  ${FOLDER}/${DB}-${BCK}.sql\033[34m\n"
mysqldump --add-drop-database --skip-comments --add-drop-table --no-tablespaces -u $USERDB -p$PWD $DB >$FOLDER/$DB-$BCK.sql
cd $FOLDER
printf "\033[33m${NOW} \033[32m== Create Backup file in ${FOLDER}/${DB}-${BCK}.sql.zip\033[39m\n"
zip $DB-$BCK.sql.zip $DB-$BCK.sql
rm -f $DB-$BCK.sql
## REMOVE PREVIOUS BACKUP
if test -f $DB-$BCKREMOVE.sql.zip; then
    NOW=$(date +'%F %H:%M:%S')
    printf "\033[33m${NOW} \033[32m== Remove previous backup ${DB}-${BCKREMOVE}.sql.zip\033[39m\n"
    rm -f $DB-$BCKREMOVE.sql.zip
fi
NOW=$(date +'%F %H:%M:%S')
printf "\033[33m${NOW} \033[32m== Backup End\033[39m\n"
