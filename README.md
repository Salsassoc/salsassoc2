Salsassoc
============

Salsassoc is a web application to manage an association.

- Github: https://github.com/Salsassoc/salsassoc2
- Bugs reporting: https://github.com/Salsassoc/salsassoc2/issues

Features
--------
- Users managment
- Membership managment
- Accounting managment

License
-------

This program is licensed under the terms of the GNU GENERAL PUBLIC LICENSE Version 3.

Requirements
------------

- composer
- symponhy-cli

Compiling from source
---------------------

Install dependencies:

    apt install php php-xml php-sqlite3 composer

Install symfony:

    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | sudo -E bash
    apt install symfony-cli

Get the code:

    git clone https://github.com/Salsassoc/salsassoc2 && cd salsassoc2

Setup project:

    composer install
    php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate

Run:

    symfony serve


