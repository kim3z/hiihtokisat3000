# hiihtokisat3000
Ohjelmoinnin erikoiskurssi - Harjoitustyö

- Alimu Ayiding
- Santeri Kuurila
- Joonas Kyttänen
- Kim Lehtinen

## Näin Github toimii

### Lisää tekemäsi muutokset
Lisää tiedostot: `git add .`

Kerro mitä ole tehnyt: `git commit -m "Kirjoita tänne jotain"`

Päivitä remote: `git push origin master`

### Hae viimeiset muutokset
`git pull origin master`

## Start application
cd `public`
`php -S localhost:4000`

## Virtuaalikone - Vagrant PHP7 (Jos haluaa käyttää)

A simple Vagrant LAMP setup with PHP 7.1 running on Ubuntu 16.04 LTS.

## What's inside?

- Ubuntu 16.04 LTS (Xenial Xerus)
- Vim, Git, Curl, etc.
- Apache
- PHP 7.1 with some extensions
- MySQL 5.7
- Node.js 8 with NPM
- RabbitMQ
- Redis
- Composer
- phpMyAdmin

## Prerequisites
- [Vagrant](https://www.vagrantup.com/downloads.html)
- Plugin vagrant-vbguest (``vagrant plugin install vagrant-vbguest``)

## How to use

- Clone this repository into your project
- Run ``vagrant up``
- Add the following lines to your hosts file:
````
192.168.100.100 app.local
192.168.100.100 phpmyadmin.local
````
- Navigate to ``http://app.local/``
- Navigate to ``http://phpmyadmin.local/`` (both username and password are 'root')
