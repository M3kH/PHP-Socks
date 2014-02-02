PHP-Socks
=========

A full enviroment for PHP log integration with SocksLogger

Install
```
git clone git@github.com:M3kH/PHP-Socks.git
cd PHP-Socks
vagrant up
vagrant ssh

# In vagrant Shell
cd /vagrant/
composer install
npm install
node main.js
```

Check-out: http://192.168.33.11:3000/ & run the thest http://192.168.33.11/test/Error.php

To run next time just
```
vagrant reload --provision
```