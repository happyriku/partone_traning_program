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
    

# Apache DocumentRootをLaravelのpublicディレクトリを指すように設定し，
# Apache設定ファイルを更新する
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

COPY ./virtualhost.conf /tmp/virtualhost.conf

RUN cat /tmp/virtualhost.conf >> /etc/apache2/apache2.conf

# apache mod rewriteを有効にする
RUN a2enmod rewrite

WORKDIR /var/www/html/SampleProject

# Apacheを起動
ENTRYPOINT ["/bin/sh", "-c", "service apache2 restart && sleep infinity"]

ENV LC_CTYPE ja_JP.UTF-8