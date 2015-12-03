LUYA
----

[![Join the chat at https://gitter.im/zephir/luya](https://badges.gitter.im/Join%20Chat.svg)](https://gitter.im/zephir/luya?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

[![License](https://poser.pugx.org/zephir/luya-module-admin/license)](https://packagist.org/packages/zephir/luya-module-admin)
[![Build Status](https://travis-ci.org/zephir/luya.svg)](https://travis-ci.org/zephir/luya)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/zephir/luya/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/zephir/luya/?branch=master)
[![Code Climate](https://codeclimate.com/github/zephir/luya/badges/gpa.svg)](https://codeclimate.com/github/zephir/luya)
[![Dependency Status](https://www.versioneye.com/user/projects/55d0ce4315ff9b0014000166/badge.svg?style=flat)](https://www.versioneye.com/user/projects/55d0ce4315ff9b0014000166)
[![Total Downloads](https://poser.pugx.org/zephir/luya/downloads)](https://packagist.org/packages/zephir/luya) 

What is **LUYA**? We have build a *fast*, *modular* and *beautiful* looking system to create content based on blocks or database tables. *LUYA* is based on the [Yii2 Framework](https://github.com/yiisoft/yii2), [Angular](https://angularjs.org) and [Materialize CSS](materializecss.com).

![Luya Admin](https://raw.githubusercontent.com/zephir/luya/master/docs/guide/img/luya-beta2.png)

### Installation

We have a made an absolut easy to understand *STEP-BY-STEP* Guide to install Luya:

+ ![Deutsch](https://raw.githubusercontent.com/savetheinternet/Tinyboard/master/static/flags/de.png) [Installationsanleitung](https://luya.io/install)
+ ![English](https://raw.githubusercontent.com/savetheinternet/Tinyboard/master/static/flags/us.png) [Setup Guide](https://luya.io/en/guide/install)

### Questions and Problems

If you have any questions or problems, don't hesitate to create a [new issue](https://github.com/zephir/luya/issues/new) on the project repository.

+ [Questions & Issues](https://github.com/zephir/luya/issues)

### Contribution

We are always looking for people who share their thoughts, code and problems with us. Below the links to the contribution guides:

+ ![Deutsch](https://raw.githubusercontent.com/savetheinternet/Tinyboard/master/static/flags/de.png) [Anleitung](https://luya.io/luya-collaboration)
+ ![English](https://raw.githubusercontent.com/savetheinternet/Tinyboard/master/static/flags/us.png) [Guide](https://luya.io/en/guide/luya-collaboration)


### Unit Tests

1. Create Database (example luya_phpunit)
2. Insert Database dump from `tests/sql/1.0.0-beta2.sql`
3. Rename phpunit.xml.dist to phpunit.xml
4. Change dsn, username and passwort in phpunit.xml
5. Ensure you have installed current composer packages `composer install`.
6. Execute the phpunit bin file `./vendor/bin/phpunit`.