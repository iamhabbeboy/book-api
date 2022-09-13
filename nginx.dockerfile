FROM nginx:1.21.4-alpine

RUN apk update && apk add \
    openssl \
    bash

# NGINX CONFIG
COPY deploy/default.conf /etc/nginx/conf.d/default.conf

# ENTRYPOINT nginx -g 'daemon off;'

EXPOSE 80
