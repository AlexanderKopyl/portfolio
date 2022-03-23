FROM nginx:1.19

RUN mkdir ./etc/nginx/ssl

RUN apt-get update && \
    apt-get install -y openssl

RUN openssl req -x509 -newkey rsa:2048 -sha256 -days 730 -nodes \
  -keyout /etc/nginx/ssl/portfolio.key -out /etc/nginx/ssl/portfolio.crt \
  -subj "/C=UA/ST=Ukraine/L=Ukraine/O=Global Security/OU=IT Department/CN=www.portfolio.com"
