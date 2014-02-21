#!/usr/bin/env bash

FIRST_INSTALL_OR_UPDATE=true
DEV_ENV=true

#set bash colors
yellow='\e[1;33m'
nocolor='\e[0m'

#set to non-interactive installs
export DEBIAN_FRONTEND=noninteractive



echo -e "${yellow}Update and upgrade linux${nocolor}"
apt-get update
apt-get upgrade -y

echo -e "${yellow}Installing servers and software${nocolor}"
apt-get install -y -q curl git gcc make apache2 mysql-server php5 php5-dev php5-cli php5-mysql php5-mcrypt php5-json



if [ -f /usr/lib/php5/20090626+lfs/phalcon.so ] ; then
    echo -e "${yellow}Phalcon alredy compiled${nocolor}"
else
    echo -e "${yellow}Compiling phalcon...${nocolor}"
    git clone --depth=1 git://github.com/phalcon/cphalcon.git
    cd cphalcon/build
    sudo ./install
fi


if $DEV_ENV ; then

    echo -e "${yellow}Installing xdebug${nocolor}"
    apt-get install -y -q php5-xdebug
    if [ -d /var/log/xdebug ] ; then
        echo -e "${yellow}Xdebug log directory already exists.${nocolor}"
    else
        echo -e "${yellow}Creating xdebug log directory: /var/log/xdebug${nocolor}"
        mkdir /var/log/xdebug
    fi
    echo -e "${yellow}Changing xdebug log directory owner to www-data${nocolor}"
    chown www-data:www-data /var/log/xdebug


    if [ -f /usr/bin/phalcon ] ; then
        echo -e "${yellow}phalcon-devtools already installed${nocolor}"
    else
        echo -e "${yellow}Installing phalcon-devtools${nocolor}"
        cd /home/vagrant
        git clone git://github.com/phalcon/phalcon-devtools.git
        ln -s /home/vagrant/phalcon-devtools/phalcon.php /usr/bin/phalcon
        chmod ugo+x /usr/bin/phalcon
    fi
fi

echo -e "${yellow}Halting servers${nocolor}"
service apache2 stop
service mysql stop

a2enmod rewrite

echo -e "${yellow}Copy server config files${nocolor}"
cp -Rf /vagrant/server_config/apache2 /etc/
cp -Rf /vagrant/server_config/php5 /etc/
cp -Rf /vagrant/server_config/mysql /etc/

echo -e "${yellow}Setup apache folder to sync folders with vagrant${nocolor}"
rm -rf /var/www
if [ -d /vagrant/www ] ; then
    echo -e "${yellow}www directory already exists.${nocolor}"
else
    echo -e "${yellow}Creating www directory${nocolor}"
    mkdir /vagrant/www
fi
ln -fs /vagrant/www /var/www

echo -e "${yellow}Restarting servers${nocolor}"
service apache2 start
service mysql start

if $FIRST_INSTALL_OR_UPDATE ; then
    echo -e "${yellow}Changing mysql root password and granting remote access${nocolor}"
    mysql -u root < /vagrant/server_config/mysql_remote_permissions/permissions.sql
fi


cd /vagrant/www
if [ -f /vagrant/www/composer.phar ] ; then
    echo -e "${yellow}Composer already installed${nocolor}"
    #php composer.phar update
else
    echo -e "${yellow}Downloading Composer and updating library dependencies...${nocolor}"
    curl -sS https://getcomposer.org/installer | php
    php composer.phar install
fi

echo -e "${yellow}Finished${nocolor}"
