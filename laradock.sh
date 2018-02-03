#!/bin/bash

# author : Alucky4423

# Laradock の相対パス
LARADOCK_PATH=".laradock/"

up () {
  docker-compose up -d nginx phpmyadmin
}

down () {
  docker-compose down
}

exeCommand () {
  docker-compose exec workspace $*
}

showHelp () {
cat << EOS

Usage:
  laradock [option] <command_name>

Option:
  -h, --help    このhelpを表示する。

Commands:
  up            laradock を起動する。
  down          laradock を終了する。

  up, down 以外のcommandを渡すと、
  laradock_workspace にcommand が渡され、実行されます。

Examples:
  ./laradock.sh php artisan make:controller
  ./laradock.sh php artisan migrate
  ./laradock.sh vendor/bin/phpunit

  のヮの
EOS
}


# validate
# 引数が0かhelpオプションなら、helpを表示
if [ "$#" == "0" ] || [ "$1" == "--help" ] || [ "$1" == "-h" ]; then
 showHelp
 exit 0
fi

pushd $LARADOCK_PATH >& /dev/null

if [ "$1" == "up" ] || [ "$1" == "down" ]; then
   eval "$1"
else
  exeCommand $*
fi

popd >& /dev/null

