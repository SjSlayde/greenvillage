#!/usr/bin/bash

mysqldump --user=admin --password=Afpa1234 --routines --triggers testdbgreenvillage > backup_testdbgreenvillage.sql
cat backup_testdbgreenvillage.sql | mysql --user=admin --password=Afpa1234 testBackup
