# DockerhubからUbuntuイメージを取得
FROM ubuntu:22.04

# 環境変数設定
ENV DEBIAN_FRONTEND=noninteractive

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 必要なパッケージをインストール
RUN apt update && apt -y upgrade && \
    apt-get update && apt-get install -y locales && \
    locale-gen ja_JP.UTF-8 && \
    apt -y install software-properties-common && \
    LC_ALL=C.UTF-8 add-apt-repository ppa:ondrej/php && \
    apt -y install tzdata && \
    apt install -y --no-install-recommends \
        ca-certificates \
        vim \
        curl \
        zip \
        unzip \
        mysql-client \
        apache2 \
        php8.2 \
        php8.2-dom \
        php8.2-curl \
        php8.2-xml \
        php8.2-redis \
        php8.2-mysql \
        php8.2-gd \
        php8.2-mbstring && \
    apt clean && rm -rf /var/lib/apt/lists/*

#docker composer install
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Apacheを起動
ENTRYPOINT ["/bin/sh", "-c", "service apache2 restart && sleep infinity"]

ENV LC_CTYPE ja_JP.UTF-8