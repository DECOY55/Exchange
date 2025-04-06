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
# Install net-tools for netstat
RUN apt-get update && apt-get install -y net-tools
EXPOSE 8000
# Debug: Log PHP version, check listening ports, and start server
CMD php --version && echo "Starting PHP server..." && php -S 0.0.0.0:8000 -t . & sleep 2 && netstat -tuln | grep 8000 && echo "PHP server should be running on 0.0.0.0:8000" && tail -f /dev/null
