FROM php:8.0-cli

WORKDIR /app
COPY . /app

# Step 1: Update package lists with retry
RUN apt-get update --fix-missing || apt-get update

# Step 2: Install dependencies one at a time for better debugging
RUN apt-get install -y default-mysql-client || { echo "Failed to install default-mysql-client"; exit 1; }
RUN apt-get install -y build-essential || { echo "Failed to install build-essential"; exit 1; }
RUN apt-get install -y net-tools || { echo "Failed to install net-tools"; exit 1; }
RUN apt-get install -y libcurl4-openssl-dev || { echo "Failed to install libcurl4-openssl-dev"; exit 1; }
RUN apt-get install -y libmariadb-dev || { echo "Failed to install libmariadb-dev"; exit 1; }
RUN apt-get install -y libonig-dev || { echo "Failed to install libonig-dev"; exit 1; }

# Step 3: Clean up
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Step 4: Install PHP extensions one at a time
RUN docker-php-ext-install pdo_mysql || { echo "Failed to install pdo_mysql"; exit 1; }
RUN docker-php-ext-install curl || { echo "Failed to install curl"; exit 1; }
RUN docker-php-ext-install mbstring || { echo "Failed to install mbstring"; exit 1; }

# Debug: List files in root and db_cryptostudio/
RUN ls -la /app
RUN ls -la /app/db_cryptostudio

EXPOSE 8000

# Start the PHP server with debug logging
CMD php --version && echo "Starting PHP server on port ${PORT:-8000}..." && php -S 0.0.0.0:${PORT:-8000} -t . & sleep 2 && netstat -tuln | grep ${PORT:-8000} && echo "PHP server should be running on 0.0.0.0:${PORT:-8000}" && tail -f /dev/null
