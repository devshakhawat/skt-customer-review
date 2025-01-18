echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/customer-reviews #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/customer-reviews/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/customer-reviews/mix-manifest.json &&
rm -rf build/customer-reviews/package.json &&
rm -rf build/customer-reviews/package-lock.json &&
rm -rf build/customer-reviews/webpack.mix.js &&
rm -rf build/customer-reviews/.babelrc &&
rm -rf build/customer-reviews/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/customer-reviews/.AppleDouble &&
rm -rf build/customer-reviews/.LSOverride &&
rm -rf build/customer-reviews/.Trashes &&
rm -rf build/customer-reviews/.AppleDB &&
rm -rf build/customer-reviews/.idea &&
rm -rf build/customer-reviews/build.sh &&
rm -rf build/customer-reviews/yarn.lock &&
rm -rf build/customer-reviews/composer.json &&
rm -rf build/customer-reviews/composer.lock &&
rm -rf build/customer-reviews/task.txt &&
rm -rf build/customer-reviews/phpcs.xml &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating customer-reviews.zip file................    (80%)'

cd build
zip -r customer-reviews.zip customer-reviews/.
rm -r customer-reviews

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"