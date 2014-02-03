PHP-Socks
=========

A full environment for PHP log integration with [SocksLogger](https://github.com/M3kH/socks-logger)

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

Check-out: http://192.168.33.11:3232/ & run the test http://192.168.33.11/test/Error.php

To run next time just
```
vagrant reload --provision
```