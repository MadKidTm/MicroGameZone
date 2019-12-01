FROM php:7.3-apache

RUN apt-get update
RUN apt-get install --no-install-recommends -y libpq-dev
RUN docker-php-ext-install pdo pdo_pgsql
RUN apt-get clean && apt-get update && apt-get install --fix-missing wget -y
RUN apt-get install -y --fix-missing gnupg
RUN echo "deb http://packages.dotdeb.org/ jessie all" >> /etc/apt/sources.list
RUN echo "deb-src http://packages.dotdeb.org/ jessie all" >> /etc/apt/sources.list
RUN cd /tmp && wget https://www.dotdeb.org/dotdeb.gpg && apt-key add dotdeb.gpg
RUN docker-php-ext-install pdo pdo_mysql pdo_pgsql

RUN apt-get clean && apt-get update && apt-get install -y --fix-missing \
  ruby-dev \
  rubygems \
  graphviz \
  sudo \
  git \
  vim \
  gnupg2 \
  imagemagick \
  libmagickwand-dev \
  memcached \
  libmemcached-tools \
  libmemcached-dev \
  libpng-dev \
  libjpeg62-turbo-dev \
  libxml2-dev \
  libxslt1-dev \
  mariadb-client \
  zlib1g-dev \
  libzip-dev \
  zip \
  wget \
  linux-libc-dev \
  libyaml-dev \
  apt-transport-https \
  zlib1g-dev \
  libicu-dev \
  libpq-dev \
  bash-completion \
  libldap2-dev \
  automake \
  libxpm-dev \
  libssl-dev

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get clean
RUN rm -rf /var/lib/apt/lists/*

RUN apt-get update
