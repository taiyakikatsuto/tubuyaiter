## Tubuyaiter (Twitterクローンアプリ)

- ローカル環境構築手順
```
git clone git@github.com:taiyakikatsuto/tubuyaiter.git

cd tubuyaiter

cp .env.example .env

docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd):/opt \
    -w /opt \
    laravelsail/php80-composer:latest \
    composer install --ignore-platform-reqs

alias sail='[ -f sail ] && bash sail || bash vendor/bin/sail'

sail up　-d

sail artisan key:generate

sail npm install

sail artisan migrate

sail artisan db:seed

sail npm run dev

```

