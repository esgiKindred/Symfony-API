
# API Symfony

Bienvenue dans le guide d'installation de l'API



## Requirements

PHP >= 8.1





## Installation

Install with composer

```bash
  composer install
```

Création de la base de données

Attention à verifier la destination dans le .env (SqlLite par défaut)

```bash
symfony console doctrine:schema:create
```

Injection du jeu de données dans la base avec les DataFixtures

```bash
symfony console doctrine:fixtures:load
```

le démarrage de l'API est prêt :

```bash
symfony serv
```
## Debug

activer cette option dans le php.ini
```bash
extension=sodium
```



```bash
  composer install
Installing dependencies from lock file (including require-dev)
Verifying lock file contents can be installed on current platform.
Your lock file does not contain a compatible set of packages. Please run composer update.

  Problem 1
    - lcobucci/jwt is locked to version 4.1.5 and an update of this package was not requested.
    - lcobucci/jwt 4.1.5 requires ext-sodium * -> it is missing from your system. Install or enable PHP's sodium extension.
  Problem 2
    - lcobucci/jwt 4.1.5 requires ext-sodium * -> it is missing from your system. Install or enable PHP's sodium extension.
    - lexik/jwt-authentication-bundle v2.16.0 requires lcobucci/jwt ^3.4|^4.0 -> satisfiable by lcobucci/jwt[4.1.5].
    - lexik/jwt-authentication-bundle is locked to version v2.16.0 and an update of this package was not requested.

To enable extensions, verify that they are enabled in your .ini files:
    - C:\php\php.ini
You can also run `php --ini` in a terminal to see which files are used by PHP in CLI mode.
Alternatively, you can run Composer with `--ignore-platform-req=ext-sodium --ignore-platform-req=ext-sodium` to temporarily ignore these required extensions.
```
