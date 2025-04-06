FROM php:8.0-cli

WORKDIR /app
COPY . /app

# Step 1: Update package lists
RUN apt-get update

# Step 2: Install dependencies for PHP extensions
RUN apt-get install -y \
    default-mysql-client \
    build-essential \
    net-tools \
    libcurl4-openssl-dev \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Step 3: Install PHP extensions
RUN docker-php-ext-install pdo_mysql curl mbstring

# Debug: List files in root and db_cryptostudio/
RUN ls -la /app
RUN ls -la /app/db_cryptostudio

EXPOSE 8000

# Start the PHP server with debug logging
CMD php --version && echo "Starting PHP server on port ${PORT:-8000}..." && php -S 0.0.0.0:${PORT:-8000} -t . & sleep 2 && netstat -tuln | grep ${PORT:-8000} && echo "PHP server should be running on 0.0.0.0:${PORT:-8000}" && tail -f /dev/null
