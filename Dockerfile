FROM dunglas/frankenphp:php8.2

WORKDIR /app

# Copy semua file dari project ke dalam container
COPY . /app

# Update dan install dependencies
RUN apt update && apt install -y zip libzip-dev && \
    docker-php-ext-install zip && \
    rm -rf /var/lib/apt/lists/*  # Membersihkan cache APT agar container lebih ringan

# Copy Composer dari official image untuk menghindari download ulang
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Perintah default untuk menjalankan aplikasi
CMD ["frankenphp", "run", "--port", "80"]
