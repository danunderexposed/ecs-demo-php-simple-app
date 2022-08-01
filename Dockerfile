FROM public.ecr.aws/amazonlinux/amazonlinux:2

# Install dependencies
RUN yum install -y \
    curl \
    httpd \
    php \
 && ln -s /usr/sbin/httpd /usr/sbin/apache2

# Update PHP
RUN yum install -y amazon-linux-extras && amazon-linux-extras enable php7.4
RUN yum clean metadata
RUN yum install -y php
RUN yum install -y php-cli php-pdo php-fpm php-json php-mysqlnd
RUN sed -i -e 's/\/var\/www\/html/\/var\/www\/html\/public/g' /etc/httpd/conf/httpd.conf
RUN apachectl restart

# Install app
RUN rm -rf /var/www/html/* && mkdir -p /var/www/html
ADD src /var/www/html


# Configure apache
RUN chown -R apache:apache /var/www
ENV APACHE_RUN_USER apache
ENV APACHE_RUN_GROUP apache
ENV APACHE_LOG_DIR /var/log/apache2

EXPOSE 80

CMD ["/usr/sbin/apache2", "-D",  "FOREGROUND"]
