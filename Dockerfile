FROM php:7.3-alpine AS build

RUN apk add --no-cache wget \
    && cd /tmp \
    && wget --quiet https://download.newrelic.com/php_agent/release/newrelic-php5-9.13.0.270-linux-musl.tar.gz \
    && gzip -dc newrelic-php5-9.13.0.270-linux-musl.tar.gz | tar xf -

FROM php:7.3-alpine

COPY --from=build /tmp/newrelic-php5-9.13.0.270-linux-musl /usr/src/newrelic-php5-9.13.0.270

ENV NR_INSTALL_SILENT=1
ENV NR_INSTALL_KEY=""

RUN /usr/src/newrelic-php5-9.13.0.270/newrelic-install install


