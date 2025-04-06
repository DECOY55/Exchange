# Use the official PHP 8.0 image with CLI
FROM php:8.0-cli

# Set the working directory inside the container
WORKDIR /app

# Copy all project files into the container
COPY . /app

# Update package sources and install dependencies
RUN apt-get update && apt-get install -y \
    # Install default-mysql-client instead of libmysqlclient-dev
    default-mysql-client \
    # Ensure build-essential for compiling extensions
    build-essential \
    # Clean up to reduce image size
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* \
    # Install the pdo_mysql extension
    && docker-php-ext-install pdo_mysql

# Expose port 8000 (Render listens on this port by default)
EXPOSE 8000

# Command to start the PHP built-in server
CMD ["php", "-S", "0.0.0.0:8000", "-t", "."]
