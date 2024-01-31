#!/bin/bash
path=~/Downloads/Challenges/hiit

cd ${path} && rm [mw\_bt]*@[1-2]x.jpg
echo filename ?
read name

if [ ! -d "$path/images" ]
then
    echo "File doesn't exist. Creating now"
    mkdir ${path}/images
    echo "File created"
else
    echo "File exists"
fi

for i in `ls ${path}`

do
    fname=`basename $i`
	replace_filename=`echo $i | sed -e "s/Full@1x/${name}/"`
	replace_filename=`echo $replace_filename | sed -e "s/Full@2x/${name}_full/"`
	replace_filename=`echo $replace_filename | sed -e "s/Full@3x/${name}_raw/"`
	replace_filename=`echo $replace_filename | sed -e "s/\([mw]*_[bt]*@3x\)/${name}_\1/"`
	replace_filename=`echo $replace_filename | sed -e "s/@[1-3]x//"`

	# echo "$replace_filename"

    cp $i ${path}/images/$replace_filename
done

find ${path} -maxdepth 1 -type f -delete