echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/product-reviews #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/product-reviews/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/product-reviews/mix-manifest.json &&
rm -rf build/product-reviews/package.json &&
rm -rf build/product-reviews/package-lock.json &&
rm -rf build/product-reviews/webpack.mix.js &&
rm -rf build/product-reviews/.babelrc &&
rm -rf build/product-reviews/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/product-reviews/.AppleDouble &&
rm -rf build/product-reviews/.LSOverride &&
rm -rf build/product-reviews/.Trashes &&
rm -rf build/product-reviews/.AppleDB &&
rm -rf build/product-reviews/.idea &&
rm -rf build/product-reviews/build.sh &&
rm -rf build/product-reviews/yarn.lock &&
rm -rf build/product-reviews/composer.json &&
rm -rf build/product-reviews/composer.lock &&
rm -rf build/product-reviews/task.txt &&
rm -rf build/product-reviews/phpcs.xml &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating product-reviews.zip file................    (80%)'

cd build
zip -r product-reviews.zip product-reviews/.
rm -r product-reviews

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"