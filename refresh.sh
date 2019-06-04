#!/bin/bash
#
# Copy the new openemr version to the web directory 
# does not touch sites, globals.php or database

GITDIR=/home/growlingflea/git/growlingflea
SITEDIR=/var/www/html/growlingflea.com

USRGRP=www-data

sudo rsync -i --recursive --exclude .git --exclude .idea ${GITDIR}/* ${SITEDIR}/ 

sudo chown -R www-data:www-data ${SITEDIR}

echo "success"
