#!/bin/bash
#
# Copy a file from the var/www folder to git directory.
# This works best for working on single files at a time.  Immediate changes
# in the live local host directory can be seen without having to run the refresh script over-and-over
# 
WEBDIR=$1  #this is the webdirectory
TARGET=$2  #this is the git directory target
if [[ ${WEBDIR} = ""] || [${TARGET} = ""]]; then
    
	echo "Please enter the filename you wish to copy"
	echo "Example: cpemr openemr interface/summary/file.php"
	exit 1;
		
fi

FILENAME='/var/www/'${WEBDIR}/${TARGET}

echo Update ${FILENAME} to ${TARGET}?
echo "You must be in local directory.  You are currently in "`pwd`
read x
rsync -r $FILENAME $TARGET 
git status




