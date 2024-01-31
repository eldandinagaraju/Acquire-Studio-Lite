FROM sureifylabs/php-fpm:0.4

# RUN apk upgrade

# USER www-data:www-data

WORKDIR /var/www/html

# COPY --chown=www-data:www-data  ./ ./

COPY nginx.conf /etc/nginx/conf.d/default.conf

RUN ln -sf /dev/stdout /var/log/nginx/access.log

EXPOSE 80

ENTRYPOINT ["./scripts/start-FPM.sh"]
