# Список всех файлов php для перевода в файл tmp/php-list
touch 'test'
echo 'start'
mkdir src/tmp
touch src/tmp/php-list
find ./build/ -iname "*.php" > src/tmp/php-list

