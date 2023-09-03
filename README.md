#!/usr/bin/env sh
. "$(dirname -- "$0")/_/husky.sh"

# Rodar o phpstan
./vendor/bin/phpstan
if [ $? -ne 0 ]; then
echo "Opa! Deu ruim aqui com PHPSTAN. Arrume antes de continuar... 😉";
exit 1;
fi;

# rodar os testes
php artisan test --parallel | php
if [ $? -ne 0 ]; then
echo "Opa! Deu ruim aqui com algum teste. Arrume antes de continuar... 😉";
exit 1;
fi;

# Formatar cada arquivo alterado usando o Laravel Pint
STAGED_FILES=$(git diff --cached --name-only --diff-filter=ACM | grep ".php\{0,1\}$") || true

for FILE in $STAGED_FILES
do
./vendor/bin/pint "${FILE}" > /dev/null >&1;
git add "${FILE}";
done;

exit 0;
