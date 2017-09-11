#!/bin/bash
#
#Background:
#Mi-squared and GrowlingFlea software  have a policy to make changes only on in the gitrepo and not make changes directly on the live site (/var/www/X) directory.
#To automate things, we designed a script that uses rsync to transfer files from the git repo to the live site.  At the same time we have multiple vendors who also work with
#the same customer who have chose to  make changes direrctly to the live site, not using source control.  This resulted in conflicts.  To avoid these conflicts and to address the issue of vendors who
#were either unable or unwilling to use source control, we created a script that updates the git repo with new files in the live site.  This allows developers who use source
#control to keep the git repo updated with changes made on the live site.  
#
#There is the occasion where there are files that we do not want added to the git repo.  There is also the occasion that a developer will mistakenly update the live site 
#with the wrong branch, then reupdate the site with the correct branch, leaving unnecessary files in the repo.  When the /var/www/X to git repo script is run, it adds these files
# to the repo.  This script allow the user to move these extra files to a temproary folder and delete them at a alater date.  We move these files instead of delete them to
# prevent errenous deletions where there are conflicts between the vendors who use src countrol and those who don't. 
# 
#
# Here is the process:
#
# 1. After the mk-prod-br-script is run, files that were deleted in the git repo may reappear in the git repo.  This makes for a mess
# 2. The script runs the 'git status -s' command and lists each file that doesn't belong.
# 3. Instead of deleting, the file is moved to a folder in the home directory.  This is done to protect mistaken deletions. 
# 4. The files in the tmp directory are not deleted until the end user removes the file.  It is recommended that the end user
#    use the application before deleting the tmp folder.

#determine the location of the files to be deleted.  Example '/var/www/openemr/'
#make sure it exists.  This is in the first argument.
target=$1

if [ "${target}" = "" ];then
		echo Requires a target directory such as /var/www/openemr as arg 1
		exit
	else
		#make sure the location exists
		if [ ! -d "${target}" ];then
			echo Directory does not exist, please double check spelling
			exit
		fi
fi

#make sure that the temp directory exists. If this is blank, files will be stored in ~/tmpEMR.  If ~/tmpEMR doesn't exist, it will be created.
tmpdir=$2
TMPDIRSTRING=""
clear

if [ "$tmpdir" = "" ];then
	#assign a value
	tmpdir="~/tmpEMR"
	echo "You left it blank"
	else tmpdir=$tmpdir
fi
#confirm that tmpdir is the directory you want to move to, if it doesn't exist one will be created

echo "\n Move files to $tmpdir?  If it does not exist, \n the directory will be created for you. (y or n) \n"
read  X
	if [ "$X" = "Y" ] || [ "$X" = "y" ] 
		then

		if [ ! -d "$tmpdir" ]
			then
			echo Creating $tmpdir.  Files will now be moved to this home directory
			mkdir -p "$tmpdir"
		else echo "\n\n$tmpdir exists!!\n\n"
		fi
	else 
	 echo "\n\nExiting program. \nChoose your target folder for the x-fer of files \nby including a 2nd argument to the script\n\n"
	fi




#Run git status -s.  List file one by one to the user.  Allow them to move the file or not.  Sometimes things like cookies should not be removed
clear
echo "You have chosen to remove files from the $1 directory to move them to the $tmpdir."
echo "In the case you make a mistake, they can be recovered"
echo "Files not moved will be deleted. \n\n *** Choose any key to begin. ***  \n\n"
read Y

for fn in `git status -s`; do
	if [ $fn != "??" ] && [ ${#fn} -gt 1 ];then
		echo "Move $target/$fn to $tmpdir/$fn? \nAny key other than 'n' will move the file"
		X=""
		read X
		if [ "$X" != 'n' ]; then
			echo "TARGET: $target/$fn \nDESTINATION: $tmpdir/$fn \n\n"
			mkdir -p $tmpdir/$fn
			sudo mv $target/$fn $tmpdir/$fn
		else echo "TARGET: $target/$fn has been left in alone \n\n"   
		fi
	fi
done



#for each member, determine if it should be deleted

