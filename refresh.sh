#!/bin/bash
#
# Copy the new openemr version to the web directory 
# does not touch sites, globals.php or database

GITDIR=/home/growlingflea/git/growlingfleaSoftware
SITEDIR=/var/www/html/___webDesign/growlingfleaSoftware.dev

USRGRP=www-data

sudo rsync -i --recursive --exclude .git --exclude .idea ${GITDIR}/* ${SITEDIR}/ 

sudo chown -R www-data:www-data ${SITEDIR}

echo "success"
