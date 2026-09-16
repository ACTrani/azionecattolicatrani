FROM php:5.6-apache

# Legacy site uses the removed-in-PHP7 mysql_* API, plus mysqli for tooling.
# These are bundled PHP extensions (no apt packages needed, so archived Debian
# repos are not a problem).
RUN docker-php-ext-install mysqli mysql \
    && a2enmod rewrite

# Quieter logs for the deprecated mysql_* calls during local dev.
# The legacy code calls error_reporting(E_ALL ^ E_NOTICE) at runtime, which
# re-enables deprecation/warning spam regardless of the ini level. So we simply
# turn OFF on-screen display (errors still go to the Apache log) for a clean page.
RUN { \
      echo 'error_reporting = E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT'; \
      echo 'display_errors = Off'; \
      echo 'log_errors = On'; \
      echo 'date.timezone = Europe/Rome'; \
    } > /usr/local/etc/php/conf.d/local-dev.ini

EXPOSE 80
