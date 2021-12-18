# Challenge name: wanna_race
FROM ubuntu:18.04
ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update
RUN apt-get install -y apache2 mysql-server git net-tools php7.2 \
	php7.2-fpm \
	php7.2-common \
	libapache2-mod-php \
	php7.2-pdo \
	php7.2-mysqli

RUN a2enmod mpm_prefork && a2enmod php7.2

WORKDIR /var/www/html/
RUN rm -rfv index.html
COPY web/ /var/www/html/
COPY src/ /root/

RUN chown www-data:www-data /var/www/html -R 
RUN chmod 755 /var/www/html

CMD ["bash", "-c", "/bin/bash /root/run.sh"]

EXPOSE 80