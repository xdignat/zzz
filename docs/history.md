git init

git remote add origin git@github.com:xdignat/zzz.git

git fetch --all

git checkout master

docker run --rm -v $(pwd):/app composer install

docker-compose build app

docker-compose up -d
