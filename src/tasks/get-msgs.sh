# $1 - имя файла .po в видe ru_RU, en_GB ...
# $2 - путь к файлу .po
mkdir src/languages
filePO="$2$1.po"
touch $filePO
xgettext -j -f $3 --from-code=utf-8 --keyword=__ --keyword=_e --keyword=_n --keyword=_x  -o $filePO
sed -i 's/charset=CHARSET/charset=UTF-8/g' $filePO
fileMO="$2$1.mo"
msgfmt -o $fileMO $filePO
