#!/bin/sh

# Exporting Environment
if [[ "$ENVIRONMENT" != 'local' ]]; then
	if [[ -z "$1" ]]; then
		aws s3 cp s3://carrier-env/$CLIENT/$ENVIRONMENT/ios.pem  /var/www/html/application/certs/ios.pem
	fi
	eval $(aws s3 cp s3://carrier-env/$CLIENT/$ENVIRONMENT/.env - | sed '/^#/ d' | sed '/^\s*$/d'| sed 's/^/export /')
fi

if [[ "$1" == 'cron' ]]; then
	# Executing Cron
	shift
	echo "Executing job: $@"
	export DB_DEBUG="TRUE"
	php index.php $@
	exit 0
fi

if [[ "$1" == 'mysql' ]]; then
	mysql -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -h $PHINX_MYSQL_HOST -D $PHINX_MYSQL_DB
fi

if [[ "$1" == 'mysqldump' ]]; then
	shift
	mysqldump -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -h $PHINX_MYSQL_HOST $PHINX_MYSQL_DB $@
	exit 0
fi

if [[ "$1" == 'init' ]]; then
	# init DB
	if [[ -z "$2" ]]; then
		sh ./scripts/db_setup.sh init
	elif [[ "$2" == "test" ]]; then
		sh ./scripts/db_setup.sh init
	fi
fi

if [[ "$1" == 'resqueue' ]]; then
	shift
	echo "Executing php $@"
	php $@
fi

if [[ "$1" == 'resqueue_scheduler' ]]; then
	shift
	application/vendor/bin/resque-scheduler $@
fi

if [[ "$1" == 'bash' ]]; then
	echo "Build bash command"
	/bin/sh -c sh
	#docker-compose run app bash
fi

if [[ "$1" == 'test' ]]; then
	cd application/tests && php phpunit
	exit $?
fi

if [[ "$1" == 'phinx' ]]; then
	./application/vendor/bin/$@
	exit $?
fi

if [[ -z "$1" ]]; then
	
    # Setting MySQL Flags
    if [[ "$ENVIRONMENT" == 'local' ]]; then
    	
    	echo "Configuring host server as host.sureify.internal ..."
		ip -4 route list match 0/0 | awk '{print $3" host.sureify.internal"}' >> /etc/hosts
		
		# echo "Enabling x-debug .."
    	# docker-php-ext-enable xdebug

    	echo "Waiting for mysql. This may take few more seconds ..."
    	until mysql -h $PHINX_MYSQL_HOST -u $PHINX_MYSQL_USER -p$PHINX_MYSQL_PWD -e "SELECT 1"; do
  			>&2 echo "Waiting for mysql. This may take few more seconds ..."
  			sleep 3
		done
    fi
    
	# Run migrations
	./application/vendor/bin/phinx migrate -e development

	if [[ $? != 0 ]]; then
		echo "Error while executing phinx migrations"
	fi

	# Removing old pid file
	rm -rf /var/run/httpd/*

	# Start server
	# /usr/sbin/httpd -DFOREGROUND
	php-fpm -D
	nginx -g 'pid /tmp/nginx.pid; daemon off;'
fi