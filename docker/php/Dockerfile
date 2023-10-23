FROM php:8.2-cli
MAINTAINER Diego Gullo <diego_gullo@bizmate.biz>

RUN apt-get update && apt-get install -y ssh git zip locales locales-all wget\
	&& pecl install xdebug-3.2.2 && docker-php-ext-enable xdebug && docker-php-ext-install bcmath && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN mkdir -p /home/composer && chmod 777 /home/composer && cd /usr/local/bin \
	&& bash -c "$(wget -qO - 'https://get.symfony.com/cli/installer')" '' --install-dir=/usr/local/bin
