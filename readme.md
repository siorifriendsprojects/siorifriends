# 栞フレンズ

## install

```bash
$ git clone https://github.com/siorifriendsprojects/siorifriends.git
$ cd siorifriends
```

## 初期設定

```bash
$ cp -p .env.example .env
$ php artisan key:generate
```

## docker 環境の構築

```
$ git clone https://github.com/LaraDock/laradock.git .laradock
$ cd .laradock
$ cp env-example .env
$ docker-compose up -d nginx phpmyadmin
$ docker exec -it laradock_workspace_1 /bin/bash
# composer install
# exit
```

ブラウザで`localhost` にアクセスする


## laradock.sh

### prepare

```
$ chmod 774 laradock.sh
```

### how to use

#### laradock の起動

```
$ ./laradock.sh up
```

#### laradock の終了

```
$ ./laradock.sh down
```

#### その他

```
$ ./laradock php artisan migrate
$ ./laradock vendor/bin/phpunit
```
