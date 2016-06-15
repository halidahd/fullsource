#!/bin/bash
FILES=./*.po
echo Enter the text domain
read TEXTDOMAIN
for f in $FILES
	do
		basefile="${f%.*}"
		/usr/local/opt/gettext/bin/msgmerge "$basefile".po "$TEXTDOMAIN".pot > tmp.po
		mv tmp.po "$basefile".po
		/usr/local/opt/gettext/bin/msgfmt -o "$basefile".mo "$basefile".po
		#echo $basefile
		#ls $f
	done
	echo done
exit
