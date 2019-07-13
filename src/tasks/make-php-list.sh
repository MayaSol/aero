# Список всех файлов php для перевода в файл tmp/php-list
# Список всех файлов php для перевода в файл tmp/php-list
#echo 'start2'
rm src/tmp/php-list
mkdir src/tmp
touch src/tmp/php-list
find ./build/ -iname "*.php" > src/tmp/php-list

