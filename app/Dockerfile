# Base da imagem PHP com Apache
FROM php:8.0-apache

# Define o diretório de trabalho dentro do container
WORKDIR /var/www/html

# Instala extensões necessárias e remove arquivos temporários
RUN apt-get update && apt-get install -y \
    libzip-dev zip unzip \
    && docker-php-ext-install mysqli \
    && docker-php-ext-enable mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia apenas os arquivos necessários para o container
COPY . .

# Define permissões apropriadas
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Expõe a porta padrão do Apache
EXPOSE 80
