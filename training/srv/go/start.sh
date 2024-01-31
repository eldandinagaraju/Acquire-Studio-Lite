#!/bin/bash

IS_LOCAL=true
export GOROOT=/usr/local/go
export SERVICE=api
export TMPPATH=/go/tmp

if [[ "$1" == 'gomod' ]]; then
	cd /go/src/api
	echo "Executing go mod ${*:2}"
	go mod ${*:2}
fi

if [[ "$1" == 'bash' ]]; then
	echo "Build bash command"
	/bin/sh -c bash
fi


if [[ "$1" == 'run' ]]; then
	echo "Executing job: $2"
	./api -j $2
fi

if [[ "$1" == 'bee' ]]; then
	cd /go/src/api && /go/src/api/bin/bee ${*:2}
fi

if [[ "$1" == 'migrate' ]]; then
  cd /go/src/api
  if [[ "$2" == 'create' ]]; then
    echo "Create migration ..."
    ../../bin/migrate create -ext=sql -dir=./database/migrations ${*:3}
    else
      echo "Run migrate ${*:2} ..."
      ../../bin/migrate -path=./database/migrations -database "mysql://${DB_USER}:${DB_PWD}@tcp($DB_HOST:3306)/${DB_DB}" ${*:2}
    fi
fi

if [[ -z "$1" ]]; then
	appPath="src/api"

	cd ${appPath}

	if $IS_LOCAL; then
		go mod vendor -v
		export GOFLAGS=-mod=vendor
		/go/bin/bee run -e pkg
	else
		./api
	fi
fi
