FROM php:8.0-cli
WORKDIR /app
COPY . /app
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    build-essential \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql
# Debug: List files in root and db_cryptostudio/
RUN ls -la /app
RUN ls -la /app/db_cryptostudio
EXPOSE 8000
# Debug: Log PHP version and confirm server start
CMD php --version && echo "Starting PHP server..." && php -S 0.0.0.0:8000 -t .