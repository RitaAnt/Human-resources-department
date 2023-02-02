FROM PHP

WORKDIR /app

COPY . .

CMD ["php", "index.php"]