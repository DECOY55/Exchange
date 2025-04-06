FROM php:8.0-cli
WORKDIR /app
COPY . /app
RUN apt-get update && apt-get install -y \
    default-mysql-client \
    build-essential \
    net-tools \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql curl mbstring
# Debug: List files
RUN ls -la /app
RUN ls -la /app/db_cryptostudio
EXPOSE 8000
# Use PORT env variable, default to 8000
CMD php --version && echo "Starting PHP server on port ${PORT:-8000}..." && php -S 0.0.0.0:${PORT:-8000} -t . & sleep 2 && netstat -tuln | grep ${PORT:-8000} && echo "PHP server should be running on 0.0.0.0:${PORT:-8000}" && tail -f /dev/null
