# Use the official PHP 8.0 image with CLI (command-line interface)
FROM php:8.0-cli

# Set the working directory inside the container
WORKDIR /app

# Copy all project files into the container
COPY . /app

# Install any necessary PHP extensions (e.g., for MySQL database)
RUN apt-get update && apt-get install -y \
    libmysqlclient-dev \
    && docker-php-ext-install pdo_mysql

# Expose port 8000 (Render listens on this port by default)
EXPOSE 8000

# Command to start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
