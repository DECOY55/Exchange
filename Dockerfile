FROM php:8.0-cli
WORKDIR /app
COPY . /app
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    build-essential \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql
EXPOSE 8000
CMD ["php", "-S", "0.0.0.0:8000", "-t", "db_cryptostudio/"]
