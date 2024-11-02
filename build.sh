echo "$(tput setaf 6)" &&

echo 'Building production version...' &&

npm run production
echo -ne 'Production version created......              (30%)\r'

rm -rf build
mkdir -p build/review-booster #multiple folder creation

echo -ne 'Cleanup and building files started........            (40%)\r'

rsync -r --exclude '.git' --exclude '.svn' --exclude 'build' --exclude 'node_modules' --exclude 'dev' --exclude '.vscode' . build/review-booster/

echo -ne 'Files copied............        (60%)\r'

rm -rf build/review-booster/mix-manifest.json &&
rm -rf build/review-booster/package.json &&
rm -rf build/review-booster/package-lock.json &&
rm -rf build/review-booster/webpack.mix.js &&
rm -rf build/review-booster/.babelrc &&
rm -rf build/review-booster/.gitignore &&
find . -type f -name '*.DS_Store' -ls -delete &&
rm -rf build/review-booster/.AppleDouble &&
rm -rf build/review-booster/.LSOverride &&
rm -rf build/review-booster/.Trashes &&
rm -rf build/review-booster/.AppleDB &&
rm -rf build/review-booster/.idea &&
rm -rf build/review-booster/build.sh &&
rm -rf build/review-booster/yarn.lock &&
rm -rf build/review-booster/composer.json &&
rm -rf build/review-booster/composer.lock &&
rm -rf build/review-booster/task.txt &&
rm -rf build/review-booster/phpcs.xml &&

find . -type f -name '*.LICENSE.txt' -ls -delete &&

echo -ne 'Creating review-booster.zip file................    (80%)'

cd build
zip -r review-booster.zip review-booster/.
rm -r review-booster

echo -ne 'Congratulations... Successfully done....................(100%)'

npm run development
echo -ne 'Development version restored....................(100%)\r'

echo "$(tput setaf 2)" &&
echo "Clean process completed!"
echo "$(tput sgr0)"