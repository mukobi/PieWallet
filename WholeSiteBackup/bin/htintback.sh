#!/bin/sh
TARGETFILE="$1"
INTFILE=~/.bin/iterator.txt
read INT < $INTFILE
NEWINT=$(( $INT + 1 ))
mkdir ~/bak > /dev/null 2>&1
cp  ~/public_html/css/buybox"$INT".css ~/bak
cp  ~/public_html/css/style"$INT".css  ~/bak
cp  ~/public_html/css/buybox"$INT".css ~/public_html/css/buybox"$NEWINT".css  
cp  ~/public_html/css/style"$INT".css  ~/public_html/css/style"$NEWINT".css  
cp "$TARGETFILE" ~/bak/"$TARGETFILE"-"$INT"
sed	/\\/css\\/style"$INT".css/,/\\/css\\/buybox"$INT".css/s/"$INT".css/"$NEWINT".css/ \
	> "$TARGETFILE" < ~/bak/"$TARGETFILE"-"$INT" 
rm  ~/public_html/css/buybox"$INT".css
rm  ~/public_html/css/style"$INT".css
echo "$NEWINT" > $INTFILE
