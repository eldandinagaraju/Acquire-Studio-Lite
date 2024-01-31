#!/bin/sh
# This script will be executed inside a docker container (web)

# waiting for db container to be ready
# TODO: Add logic to overcome indefinite waiting
until mysql -h $PHINX_MYSQL_HOST -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -e "SELECT 1"; do
  >&2 echo "Waiting for mysql. This may take few more seconds ..."
  sleep 3
done

>&2 echo "mysql is up - executing command"

if [[ $1 == "test" ]]; then
	echo "Initating test db"
	PHINX_MYSQL_DB="test_${PHINX_MYSQL_DB}"
fi

# Drop existing DB
mysql -v -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -h $PHINX_MYSQL_HOST -e "DROP DATABASE ${PHINX_MYSQL_DB}"

# creating db
mysql -v -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -h $PHINX_MYSQL_HOST -e "CREATE DATABASE ${PHINX_MYSQL_DB}"

# Creating schema and loading data
echo "Creating schema"
mysql -v -u root -p$PHINX_MYSQL_PWD -h $PHINX_MYSQL_HOST -D $PHINX_MYSQL_DB < ./db/base/base.sql

