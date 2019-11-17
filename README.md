# Test runner

## Подготовленныые макеты

/test-cases  
/test-runs  
/test-runs/1


## Run local server
 
You can run it out using PHP's built-in web server:

```bash
$ php -S 0.0.0.0:8080 -t public/ public/index.php
# OR use the composer alias:
$ composer run --timeout 0 serve
```

## Development mode

The skeleton ships with [zf-development-mode](https://github.com/zfcampus/zf-development-mode)
by default, and provides three aliases for consuming the script it ships with:

```bash
$ composer development-enable  # enable development mode
$ composer development-disable # disable development mode
$ composer development-status  # whether or not development mode is enabled
```

## Running Unit Tests

Once testing support is present, you can run the tests using:

```bash
$ ./vendor/bin/phpunit
```

## QA Tools

```bash
# Run CS checks:
$ composer cs-check
# Fix CS errors:
$ composer cs-fix
# Run PHPUnit tests:
$ composer test
```

## Docker mysql commands

```
sudo docker pull mysql/mysql-server:5.5
sudo mkdir /var/lib/mysql
sudo docker run --name=mysql \
--mount type=bind,src=/var/lib/mysql,dst=/var/lib/mysql \
-d --rm --network bridge mysql/mysql-server:5.5
sudo docker logs mysql1 2>&1 | grep GENERATED
sudo docker exec -it mysql mysql -uroot -p // устанавливаем пароль рута
SET PASSWORD FOR root@localhost = PASSWORD('111');
CREATE DATABASE test_runner;
CREATE USER test_runner@localhost IDENTIFIED BY '111';
GRANT ALL PRIVILEGES ON *.* TO test_runner@localhost;
FLUSH PRIVILEGES;
// запускаем так
sudo docker run --name=mysql --mount type=bind,src=/var/lib/mysql,dst=/var/lib/mysql -d --rm --network bridge mysql/mysql-server:5.5
```

## Local servers

[Как установить Linux, Nginx, MySQL, PHP (LEMP) в Ubuntu 16.04](https://www.digitalocean.com/community/tutorials/linux-nginx-mysql-php-lemp-ubuntu-16-04-ru)
[How to Install PHP 7.2 on Ubuntu 16.04](https://thishosting.rocks/install-php-on-ubuntu/)

## Web-server TestRunner

http://test-runner.essay.office - web-server TestRunner
```
$ apt-get update
$ apt-get install nginx
$ apt-get install python-software-properties
$ add-apt-repository ppa:ondrej/php
$ apt-get update
$ apt-get install php7.2
$ apt-get install php-pear php7.2-fpm php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml
$ apt-get install git
```

### Callbacks
* /test-run/result/:id/hosts-ready
* /test-run/result/:id
* /test-run/:id/save-output

## Workers 

```
$ apt-get update
$ apt-get install python-software-properties
$ add-apt-repository ppa:ondrej/php
$ apt-get update
$ apt-get install php7.2
$ apt-get install php-pear php7.2-curl php7.2-dev php7.2-gd php7.2-mbstring php7.2-zip php7.2-mysql php7.2-xml php7.2-bcmath php7.2-imap
$ apt-get install git
$ apt-get install supervisor
$ nano /etc/supervisor/conf.d/consume.conf
[program:consume]
directory=/var/www/essay
command=/usr/bin/php lib/RabbitMQ/consume.php test TestsRunner
autostart=true
autorestart=true
stopsignal=KILL
numprocs=1
stderr_logfile=/var/log/consume.err.log
stdout_logfile=/var/log/consume.out.log

$ sudo apt-key adv --keyserver hkp://p80.pool.sks-keyservers.net:80 --recv-keys 58118E89F3A912897C070ADBF76221572C52609D
$ sudo apt-add-repository 'deb https://apt.dockerproject.org/repo ubuntu-xenial main'
$ sudo apt-get update
$ apt-cache policy docker-engine
$ apt-get install -y docker-engine
```
    
1. 192.168.216.89 - worker with Chrome
    ```
    $ docker run --name selenium-server -p 4444:4444 -v /dev/shm:/dev/shm -d -it --rm --network host  selenium/standalone-chrome
    $ or docker run --name selenium-server -v /dev/shm:/dev/shm -d -it --rm --network host  selenium/standalone-chrome-debug:3.5.3-boron
    ```
1. 192.168.216.23    test-ubuntu-9    
1. 192.168.216.24    test-ubuntu-10    
1. 192.168.216.25    test-ubuntu-11    
1. 192.168.216.26    test-ubuntu-12    
1. 192.168.216.27    test-ubuntu-13    
1. 192.168.216.28    test-ubuntu-14    
1. 192.168.216.29    test-ubuntu-15    
1. 192.168.216.30    test-ubuntu-16    
1. 192.168.216.31    test-ubuntu-17
1. 192.168.216.32    test-ubuntu-18    
1. 192.168.216.33    test-ubuntu-19    
1. 192.168.216.34    test-ubuntu-20
1. 192.168.216.35    test-ubuntu-21    
1. 192.168.216.36    test-ubuntu-22    
1. 192.168.216.37    test-ubuntu-23    
1. 192.168.216.38    test-ubuntu-24    
1. 192.168.216.39    test-ubuntu-25    
1. 192.168.216.40    test-ubuntu-26    
1. 192.168.216.41    test-ubuntu-27    
1. 192.168.216.42    test-ubuntu-28    
1. 192.168.216.43    test-ubuntu-29    
1. 192.168.216.44    test-ubuntu-30    
1. 192.168.216.45    test-ubuntu-31    
1. 192.168.216.46    test-ubuntu-32    
1. 192.168.216.47    test-ubuntu-33    
1. 192.168.216.48    test-ubuntu-34    
1. 192.168.216.49    test-ubuntu-35    
1. 192.168.216.50    test-ubuntu-36    
1. 192.168.216.51    test-ubuntu-37    
1. 192.168.216.52    test-ubuntu-38    
1. 192.168.216.53    test-ubuntu-39    
1. 192.168.216.54    test-ubuntu-40    
1. 192.168.216.55    test-ubuntu-41
1. 192.168.216.90 - worker with Chrome
1. 192.168.216.91 - worker with Chrome
1. 192.168.216.92 - worker with Chrome
1. 192.168.216.93 - worker with Chrome
1. 192.168.216.94 - worker with Chrome
1. 192.168.216.95 - worker with Chrome

---
1. 192.168.216.XX - worker with Firefox (not work now)
    ```
    $ apt-get install php-imagick
    $ docker run --name selenium-server -p 4444:4444 -v /dev/shm:/dev/shm -d -it --rm --network host  selenium/standalone-firefox
    ```
