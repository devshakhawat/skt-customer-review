echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/skt-customer-review #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/skt-customer-review/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/skt-customer-review/mix-manifest.json &&
rm -rf build/skt-customer-review/package.json &&
rm -rf build/skt-customer-review/package-lock.json &&
rm -rf build/skt-customer-review/webpack.mix.js &&
rm -rf build/skt-customer-review/.babelrc &&
rm -rf build/skt-customer-review/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/skt-customer-review/.AppleDouble &&
rm -rf build/skt-customer-review/.LSOverride &&
rm -rf build/skt-customer-review/.Trashes &&
rm -rf build/skt-customer-review/.AppleDB &&
rm -rf build/skt-customer-review/.idea &&
rm -rf build/skt-customer-review/build.sh &&
rm -rf build/skt-customer-review/yarn.lock &&
rm -rf build/skt-customer-review/composer.json &&
rm -rf build/skt-customer-review/composer.lock &&
rm -rf build/skt-customer-review/task.txt &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating skt-customer-review.zip file................    (80%)'

cd build
zip -r skt-customer-review.zip skt-customer-review/.
rm -r skt-customer-review

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"